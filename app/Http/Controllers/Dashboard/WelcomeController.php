<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{

    public function index()
    {
        $user_count = User::whereRoleIs('admin')->count();

        $client_count = User::whereRoleIs('client')->count();

        $category_count = Category::count();

        $product_count = Product::count();

        $sales_data = Order::select(

            DB::raw('YEAR(created_at) as year'),
            DB::raw('month(created_at) as month'),
            DB::raw('sum(total_price) as sum'),
        )->groupBy('month')->get();

        //   dd($sale_data);

        return view('dashboard.welcome', compact('user_count', 'client_count', 'category_count', 'product_count', 'sales_data'));
    } //-- end index function
}//-- end welcome controller
