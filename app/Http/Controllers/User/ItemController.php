<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Item;
use App\Models\User;
use Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$items = Item::getMyItemOrderByCreated_at();
        $items = User::query()     
        ->find(Auth::user()->id)
        ->userItems()
        ->orderBy('created_at', 'desc')
        ->get();
        // ddd($items);
        return view('item.index', compact('items'));;
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
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $item = Item::create($data);
        $model_relax = config('cbd_model.model_relax');
        $model_inflammation = config('cbd_model.model_inflammation');
        $model_paschoactive = config('cbd_model.model_paschoactive');
        $unit_price = config('unit_price.unit_price');
        // ddd($unit_price);
        // ddd($model_relax);
        return view ('item.buyCheck', compact('item', 'model_relax', 'model_inflammation', 'model_paschoactive', 'unit_price'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // ddd($id);
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
        // ddd($request);
        // $result = Item::find($id)->save(['order_flg' => true]);
        // $price = $request->sum_price;
        // ddd($price);
        // $result_price = Item::find($id)->save(['sum_price' => $price]);
        if ($request->star == 0) {
            $result = Item::find($id)->update($request->all());
            $reault_price = Item::find($id)->update(['order_flg' => true]);
            return redirect()->route('user.item.index');
        } else {
            // ddd($request);
            // ddd($request->all());
            $star = $request->star;
            $result = Item::find($id)->update(['star' => $star]);
            return redirect()->route('user.item.index');
        }


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

    public function stars(Request $request) 
    {
        ddd($request->all());
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        // $data->attach();
        $star = Item::create($data);
        // ddd($data);
        // $request->user_id->attach(Auth::id());
        // ddd($data);
        return redirect('user.Item.index');
    }

}
