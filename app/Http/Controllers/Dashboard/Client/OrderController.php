<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Product;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:*orders');
        $this->middleware('permission:create_orders')->only(['create', 'store']);
        $this->middleware('permission:update_orders')->only(['edit', 'update']);
        $this->middleware('permission:delete_orders')->only('destroy');
    } //-- end construct function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {

        $client = User::findOrFail($user_id);
        $categories = Category::with('products')->get();
        $orders = $client->orders;
        // dd($orders);
        return view('dashboard.client.order.create', compact('client', 'categories', 'orders'));
    } //-- end create function

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {


        $client = User::findOrFail($user_id);

        // $order = $client->orders()->create([]);


        $order = Order::create([
            'user_id'   =>  $client->id,
            'total_price'   => 0,
        ]);

        $total_price = 0;
        foreach ($request->quantity as $product_id => $q) {

            $product = Product::findOrFail($product_id);

            $product_price = $product->finalPrice();

            $total_price += $product_price * $q;

            $stoke = $product->stoke - $q;

            $order->products()->attach($product_id, ['quantity' => $q]);

            $number = $product->number_sale + $q;

            $product->update([
                'stoke' => $stoke,
                'number_sale'   =>   $number
            ]);
        } //-- end foreach


        $order->update([
            'total_price'   =>  $total_price,
        ]);

        return redirect()->route('dashboard.order.index')->with('success', __('site.success_add'));
    } //-- end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order, User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Order $order)
    {
        //
    } //-- end edit function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, User $user)
    {
        //
    }
}//-- end model
