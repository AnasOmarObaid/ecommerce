<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


class Category extends Model
{

    use Translatable;

    public $translatedAttributes = ['name'];


    public  $fillable = ['name', 'image', 'user_id', 'status'];

    // helper--------------------------------------
    public function getImagePath()
    {
        return asset('public\images\upload\category\image\\' . $this->image);
    } //-- end getImagePath


    // relation model----------------------------
    public function user()
    {
        return $this->belongsTo('App\User');
    } //-- end users function

    public function products()
    {

        return $this->hasMany(Product::class);
    } //-- end Products function

    public function stores()
    {

        return $this->belongsToMany(Store::class, 'store_category');
    } //-- end categories function


    // scope-------------------------------------
    public function scopeWhenSearch($query, $request)
    {
        return $query->when($request->search, function ($q) use ($request) {
            return $q->where('name', "like", "%$request->search%");
        });
    } //-- end scope search
}//-- end Category model
