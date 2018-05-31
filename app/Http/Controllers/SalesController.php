<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class SalesController extends Controller
{
    /**
     * @param Sale $sale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Sale $sale){
        return view('admin.listSales',[
            'pageName'=>'Акции, Распродажи',
            'sales'=>$sale->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.createSales', [
                'pageName'=>'Создать новую акцию, распродажу',
                'action_url'=>route('admin.sales.index'),
            ]
        );
    }

    /**
     * @param Request $request
     * @param Sale $sale
     * @param MessageBag $error
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Sale $sale, MessageBag $error){
        try{
            $sale->addNewSale($request->all());
            return redirect(route('admin.sales.index'))->with('status','Добавленна новая акция');
        }catch (QueryException $e){
            $error->add('Error', implode(', ', $e->errorInfo));
            return redirect(route('admin.sales.create'))->withErrors($error);
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @param Sale $sale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Request $request, Sale $sale){
        return view('admin.createSales', [
                'pageName'=>'Редактирование Акции',
                'action_url'=>route('admin.sales.index')."/".$id,
                'sale'=>$sale->where('id',$id)->first()
            ]
        );
    }

    /**
     * @param $id
     * @param Request $request
     * @param Sale $sale
     * @param MessageBag $error
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request, Sale $sale, MessageBag $error){
        try{
            $sale->updateSale($id, $request->all());
        }catch (QueryException $e){
            $error->add('Error', implode(', ', $e->errorInfo));
            return redirect(route('admin.sales.index').'/'.$id . "/edit")->withErrors($error);
        }catch (\Exception $e){
            $error->add('Error', $e->getMessage());
            return redirect(route('admin.sales.index').'/'.$id . "/edit")->withErrors($error);
        }

        return redirect(route('admin.sales.index'))->with('status', 'Акция успешно обновилась');
    }
}
