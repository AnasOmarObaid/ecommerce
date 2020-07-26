<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Store;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

        $products = Product::with('category')->with('colors')->with('sizes')->limit(6)->get();

        $categories = Category::all();

        $hight_sales = Product::orderBy('number_sale', 'desc')->limit(5)->get();

        $offers = Product::where('new_sale_price', '!=', 'null')->limit(6)->get();

        $new_stores = Store::limit(6)->with('categories')->withCount('categories')->latest()->get();

        $countProduct = 0;

        return view('welcome', compact('products', 'categories', 'hight_sales', 'offers', 'new_stores', 'countProduct'));
    } //-- end index function
}//-- end welcome controller
