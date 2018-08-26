<?php

namespace App\Http\Controllers;

use App\Mail\CreatedOrder;
use App\Models\Category;
use App\Models\Manager;
use App\Models\Order;
use App\Models\PriceType;
use App\Models\Product;
use App\Models\UploadPrice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use App\Jobs\UpdateProductsPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class AdminDashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listOrders(Order $order)
    {
        return view('admin.listOrders', [
            'orderList' => $order->showOrdersAdmin()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProducts()
    {
        return view('admin.addProducts', [
            'data' => '',
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersList(User $user, PriceType $priceType)
    {
        return view('admin.usersList', [
            'users' => $user->with('manager')->orderBy('created_at', 'desc')->get(),
            'priceTypeList' => $priceType->get(),
        ]);
    }

    /**
     * @param Manager $manager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function managersList(Manager $manager)
    {

        return view('admin.managersList', [
            'managers' => $manager->get(),
        ]);
    }

    public function showOrder(Request $request, Order $order){
        $data = $order->listOrderDataForUser($request);
        return view('admin.showOrder',[
            'order' => $data
        ]);
    }

    public function getFile(UploadPrice $uploadPrice)
    {

        if ($connectionId = $uploadPrice->setFtpConnection()) {
            $uploadPrice->upDatePrice($connectionId);
            ftp_close($connectionId);
        }

        return 'upload price ';
    }

    public function queueMethod(Product $product, Category $category, UploadPrice $uploadPrice)
    {

        $chunkSize = 250;

        //Read price to array
        $localPriceName = storage_path('price/price.json');

        while (true) {

            $productsPriceArray = file($localPriceName);
            $ChunkToUpload = [];
            //Slice from array chunks(200 ps)
            $chunkItemCounts = (count($productsPriceArray) < $chunkSize) ? count($productsPriceArray) : $chunkSize;
            for ($i = 0; $i < $chunkItemCounts; $i++) {
                $ChunkToUpload[] = json_decode($productsPriceArray[$i], JSON_UNESCAPED_UNICODE);
                unset($productsPriceArray[$i]);
            }

            //Call Queue and pass it chunk data and slice data array
            $this->sendToQueue($ChunkToUpload, $product, $category);

            if (count($productsPriceArray) < 1) {
                //finish read price
                //if data's array empty - write to DB - update price is done ->> Pass status last chunk for set it
                //delete price file

                //todo write to DB about finish upload price
                $uploadPrice->successLoadPrice('Upload price is done', "upload products", 2);

                return 'finish upload';
            }

            file_put_contents($localPriceName, $productsPriceArray);
        }
    }

    /**
     * @param $ChunkToUpload
     * @param $product
     * @param $category
     */
    private function sendToQueue($ChunkToUpload, $product, $category)
    {

        $jobUploadPrice = (new UpdateProductsPrice($ChunkToUpload, $product, $category))->delay(Carbon::now()->addSeconds(50));
        dispatch($jobUploadPrice);
    }

    /**
     * @param User $user
     */
    public function sendEmail(User $user)
    {

        $sendTo = $user->find(2);

        Mail::to($sendTo)->send(new CreatedOrder());
    }

    /**
     * @param Category $category
     */
    public function sitemap(Category $category){

        $path = public_path('sitemap.xml');

        $site_map = Sitemap::create();

        $site_map->add(Url::create(route('home')));
        $site_map->add(Url::create(route('load_price')));
        $site_map->add(Url::create(route('sales_price')));
        $site_map->add(Url::create(route('contacts')));
        $site_map->add(Url::create(route('about_us')));
        $site_map->add(Url::create(route('pay')));
        $site_map->add(Url::create(route('store')));

        foreach ($category->all() as $item){
            $site_map->add(Url::create(route('store') . "/category/{$item->slug}" ));
        }

        $site_map->writeToFile($path);
    }
}
