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

class AdminDashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listOrders(Order $order)
    {
        $orderList = $order->showOrdersAdmin();
        return view('admin.listOrders', [
            'orderList' => $orderList
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
            'users' => $user->with('manager')->get(),
            'priceTypeList' => $priceType->get()
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
        if( Auth::user()->role == 'admin'){
            return view('admin.showOrder',[
                'order' => $data
            ]);
        }
        return redirect('/');
    }

    public function getFile(UploadPrice $uploadPrice)
    {

        if ($connectionId = $uploadPrice->setFtpConnection()) {
            $uploadPrice->upDatePrice($connectionId);
            ftp_close($connectionId);
        }

        return 'upload price ';
    }

    public function queueMethod(Product $product, Category $category)
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

    public function sendEmail(User $user)
    {

        $sendTo = $user->find(2);

        Mail::to($sendTo)->send(new CreatedOrder());
    }
}
