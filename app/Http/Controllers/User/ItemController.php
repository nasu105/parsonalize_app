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
        return view('user.item.index', compact('items'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model_relax = config('cbd_model.model_relax');
        $model_inflammation = config('cbd_model.model_inflammation');
        $model_paschoactive = config('cbd_model.model_paschoactive');
        return view('user.item.create',compact('model_relax', 'model_inflammation', 'model_paschoactive'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $item = Item::create($data);
        $model_relax = config('cbd_model.model_relax');
        $model_inflammation = config('cbd_model.model_inflammation');
        $model_paschoactive = config('cbd_model.model_paschoactive');
        $unit_price = config('unit_price.unit_price');
        // ddd($unit_price);
        // ddd($model_relax);
        // ddd($data);
        /*$result_str_array = [$item->cbd, $item->cbg, $item->cbn, $item->cbc]; 
        $result_nam_array = array_map('intval', $result_str_array);
        // ddd($result_nam_array);
        $max_nam = max($result_nam_array);
        if ($max_nam == $result_nam_array[0]) { // 最大値がcbdの時
            // ddd('cbd' . $result_nam_array[0]);
            return view ('user.item.cbdpage');
        } elseif ($max_nam == $result_nam_array[1]) { // 最大値がcbgの時
            // ddd('cbg' . $result_nam_array[1]);
            return view ('user.item.cbgpage');
        } elseif ($max_nam == $result_nam_array[2]) { // 最大値がcbnの時
            // ddd('cbn' . $result_nam_array[2]);
            return view ('user.item.cbnpage');
        } elseif ($max_nam == $result_nam_array[3]) { // 最大値がcbcの時
            // ddd('cbc' . $result_nam_array[3]);
            return view ('user.item.cbcpage');
        }
        ddd($max_nam); */
        return view ('user.item.buyCheck', compact('item', 'model_relax', 'model_inflammation', 'model_paschoactive', 'unit_price'));
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
        // $price = $request->price;
        // ddd($price);
        // $result_price = Item::find($id)->save(['price' => $price]);
        /* if ($request->star == 0) {
            $result = Item::find($id)->update($request->all());
            $reault_price = Item::find($id)->update(['cart_flg' => true]);
            return redirect()->route('user.item.index');
        } else {
            // ddd($request);
            // ddd($request->all());
            $star = $request->star;
            $result = Item::find($id)->update(['star' => $star]);
            return redirect()->route('user.item.index');
        } */
        ddd($request);
        $result = Item::find($id)->update($request->all());
        $cart_flg = Item::find($id)->update(['cart_flg' => true]);
        return redirect()->route('user.item.index');
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
        return redirect()->route('user.item.index');
    }

    public function cart()
    {
        // ddd('cart');
        $items = User::query()
            ->find(Auth::user()->id)
            ->userItems()
            ->where('cart_flg', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        // ddd($items);
        return view('user.item.cart', compact('items'));
    }

    public function cart_add (Request $request, $id)
    {
        // ddd($request);
        // ddd($id);
        $result = Item::find($id)->update($request->all());
        $cart_flg = Item::find($id)->update(['cart_flg' => true]);
        return redirect()->route('user.cart');
    }

    public function checkout() {
        $items = User::query()
            ->find(Auth::user()->id)
            ->userItems()
            ->where('cart_flg', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        // ddd($items);

        /* $lineItems = []; // Udemyでのstripe処理
        foreach($items as $item) {
            $lineItem = [
                'name' => $item->id,
                'unit_amount' => $item->price,
                'currency' => 'jpy',
                'quantity' => $item->quantity,
            ];
            array_push($lineItems, $lineItem);
        }
        // dd($lineItems);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'], // documentに記載がない部分(Udemyではある,stripeのバージョンが違うため)
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.item.index'),
            'cancel_url' => route('user.cart'),
        ]);

        $publickey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', compact('session', 'publickey')); */


        $lineItems = [];
        foreach($items as $item) {
            $lineItem = [
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->id,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => $item->quantity,
            ];
            array_push($lineItems, $lineItem);
        }
        // dd($lineItems);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'], // documentに記載がない部分(Udemyではある,stripeのバージョンが違うため)
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.succsess'),
            'cancel_url' => route('user.cart.cancel'),
        ]);

        $publickey = env('STRIPE_PUBLIC_KEY');

        return view('user.item.checkout', compact('session', 'publickey'));
    }

    public function succsess()
    {
        $items = User::query()
        ->find(Auth::user()->id)
        ->userItems()
        ->where('cart_flg', 1)
        ->get();

        foreach($items as $item) { // cart商品を消す,order_flgを立てる
            $cart_flg = Item::find($item->id)->update(['cart_flg' => false]);
            $order_flg = Item::find($item->id)->update(['order_flg' => true]);
        }

        return redirect()->route('user.item.create');
    } 

    public function cancel()
    {
        return redirect()->route('user.cart');
    }

}
