<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    } //-- end 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    } //-- end index

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
    public function store(Request $request, $cart)
    {
        // dd($request->all());
    } //-- end store function

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function add(Product $product)
    {

        $product->users()->attach(auth()->user()->id);

        return redirect()->route('front.cart.index');
    }



    public function delete(Product $product)
    {

        $product->users()->detach(auth()->user()->id);

        return redirect()->back();
    }

    public function updateCart(Request $request)
    {

        auth()->user()->products()->detach();

        foreach ($request->quantity as $product_id => $q) {


            auth()->user()->products()->attach($product_id, ['quantity' => $q]);
        } //-- end foreach


        return redirect()->route('front.user.index');
    } //-- end update cart

}
