<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductImages extends Model
{
    public $table = 'product_images';
    public $fillable = ['image', 'product_id'];

    // relationship--------------------------------
    public function product_image()
    {

        return $this->belongsTo(Product::class);
    } //-- end product image


}//-- end product images
