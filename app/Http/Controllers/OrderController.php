<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Product;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } //-- end 


    public function index()
    {
        //dd(auth()->user()->orders->products->first());

        return view('order.index');
    } //-- end index function

    public function storeProductFromCart()
    {

        // create order
        $order = Order::create([
            'user_id'   =>  auth()->user()->id,
            'total_price'   => 0,
        ]);

        $total_price = 0;

        // attach product to order
        foreach (auth()->user()->products as $product) {

            $product_price = $product->finalPrice();

            $total_price += $product_price * $product->pivot->quantity;
            $stoke = $product->stoke - $product->pivot->quantity;

            //attach
            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);

            $number = $product->number_sale + $product->pivot->quantity;

            $product->update([
                'stoke' => $stoke,
                'number_sale'   =>   $number
            ]);
        } //-- end foreach

        // update total price
        $order->update([
            'total_price'   =>  $total_price,
        ]);

        auth()->user()->products()->detach();

        return redirect()->route('front.confirm');
    } //-- end store product

    public function OrderConfirm(Order $order)
    {

        $order->update([
            'status'    =>  1,
        ]);

        return redirect()->back()->with('success', __('site.order_success_msg'));
    } //-- end OrderConfirm function


    public function create_order(Request $request, Product $product)
    {

        $order = Order::create([
            'user_id'   =>  auth()->user()->id,
            'total_price'   => 0,
        ]);

        // ini
        $total_price = 0;
        $stoke = 0;

        // update data
        $total_price = $product->finalPrice() * $request->quantity;
        $stoke = $product->stoke - $request->quantity;

        // attach
        $order->products()->attach($product->id, ['quantity' => $request->quantity]);

        // update product
        $product->update([
            'stoke' => $stoke,
            'number_sale'   =>   $product->number_sale + $request->quantity,
        ]);

        // update order
        $order->update([
            'total_price'   =>  $total_price,
        ]);

        return redirect()->route('front.order.index');
    } //-- end create_order function

}//-- end order controller
