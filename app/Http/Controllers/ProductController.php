<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //   dd($request->all());
        $categories = Category::with('products')->withCount('products')->get();

        $products_count = Product::count();

        $products = Product::with('category')->selectCategory($request)
            ->whereTranslationLike('name', "%$request->search%")
            ->get();

        return view('product.index', compact('categories', 'products_count', 'products'));
    } //-- end index function


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        $products = Product::whereCategory($product)->get();

        $all_rating = 0;

        foreach ($product->ratings as $rating) {
            $all_rating += $rating->rating;
        } //-- end foreach

        return view('product.show', compact('product', 'all_rating', 'products'));
    } //-- end show function




}
