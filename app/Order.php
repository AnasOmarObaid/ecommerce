<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';


    public $fillable = ['total_price', 'user_id', 'order_id', 'order_number', 'status'];



    // relation ------------------------------------------------------
    public function user()
    {

        return $this->belongsTo(User::class);
    } //-- end user function


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')->withPivot('quantity')->withPivot('total_price');
    } //-- end products function

    // scope ---------------------------------------------------------
    public function scopeWhenSearch($query, $request)
    {

        return $query->whereHas('user', function ($q) use ($request) {

            return
                $q->where('first_name', 'like', "%$request->search%")
                ->orWhere('last_name', 'like', "%$request->search%");
        });
    } //-- end when search function
}//-- end Order
