<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public $table = 'ratings';

    public $fillable = ['rating', 'title', 'features', 'defects', 'review', 'user_id', 'product_id'];

    // relationship -------------------------------------------

    public function user()
    {

        return  $this->belongsTo(User::class);
    } //-- end user function

    public function product()
    {

        return $this->belongsTo(Product::class);
    } //-- end user function

}//-- end model
