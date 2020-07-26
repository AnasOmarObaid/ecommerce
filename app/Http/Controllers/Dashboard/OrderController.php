<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::whenSearch($request)->latest()->paginate(5);

        return view('dashboard.order.index', compact('orders'));
    } //-- end index function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {

        $categories = Category::with('products')->get();
        $orders = $order->user->orders;
        return view('dashboard.order.edit', compact('categories', 'order', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {

        $total_price = 0;

        $order->products()->detach();

        foreach ($request->quantity as $product_id => $q) {

            $product = Product::findOrFail($product_id);

            $product_price = $product->finalPrice();

            $total_price += $product_price * $q;

            $order->products()->attach($product_id, ['quantity' => $q]);
        } //-- end foreach


        $order->update([
            'total_price'   =>  $total_price,
        ]);

        return redirect()->route('dashboard.order.index')->with('success', __('site.success_edit'));
    } //-- end update function

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if (request()->ajax()) {
            // remove the order
            $order->delete();
            return response(['msg' => 'success delete product', 'status' => 'success']);
        }
        return response(['msg' => 'failed delete product', 'status' => 'failed']);
    } //-- end destroy function


    public function products(Order $order)
    {
        foreach ($order->products as $product) {

            $product->update([

                'stoke' =>  $product->stoke + $product->pivot->quantity,
            ]); //-- end update

        } //-- end foreach 

        $products = $order->products;

        return view('dashboard.order._products', compact('products', 'order'));
    } //-- end products function
}
