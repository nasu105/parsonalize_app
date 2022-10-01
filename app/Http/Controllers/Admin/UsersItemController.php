<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Item;
use App\Models\User;
use Auth;

class UsersItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$items = Item::getMyItemOrderByCreated_at();
        $order_items = Item::query()
        ->where('order_flg','1')
        ->orderBy('created_at', 'desc')
        ->get();
        // ddd($order_items);
        return view('admin.index', compact('order_items'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request);
        // $data = $request->merge(['user_id' => Auth::user()->id])->all();
        // $item = Item::create($data);
        // return view ('item.buyCheck', compact('item'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ddd($id);
        $order_item = Item::find($id);
        $model_relax = config('cbd_model.model_relax');
        $model_inflammation = config('cbd_model.model_inflammation');
        $model_paschoactive = config('cbd_model.model_paschoactive');
        $unit_price = config('unit_price.unit_price');
        // ddd($order_item);
        return view ('admin.show', compact('order_item', 'model_relax', 'model_inflammation', 'model_paschoactive', 'unit_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $order_flg = Item::find($id)->update(['order_flg' => false]);
        return redirect()->route('admin.usersitem.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function supported_index() 
    {
        $order_items = Item::query()
        ->where('order_flg','0')
        ->where('created_order_flg', '1')
        ->orderBy('created_at', 'desc')
        ->get();
        // ddd($order_items);
        return view('admin.supported_index', compact('order_items'));;
    }

        public function supported_show($id)
    {
        // ddd($id);
        $order_item = Item::find($id);
        $model_relax = config('cbd_model.model_relax');
        $model_inflammation = config('cbd_model.model_inflammation');
        $model_paschoactive = config('cbd_model.model_paschoactive');
        $unit_price = config('unit_price.unit_price');
        // ddd($order_item);
        return view ('admin.supported_show', compact('order_item', 'model_relax', 'model_inflammation', 'model_paschoactive', 'unit_price'));
    }
}
