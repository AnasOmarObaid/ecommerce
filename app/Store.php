<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Store extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];

    public $table = 'stores';

    public $fillable = ['image', 'rating', 'category_id'];

    // helper--------------------------------------
    public function getImagePath()
    {
        return asset('public\images\upload\store\image\\' . $this->image);
    } //-- end getImagePath

    // get product count
    public function getProductCount()
    {
        $count = 0;

        foreach ($this->categories as $category) {

            foreach ($category->products as $product) {
                ++$count;
            }
        }

        return $count;
    } //-- end get product count

    // relation---------------------------------
    public function categories()
    {

        return $this->belongsToMany(Category::class, 'store_category');
    } //-- end categories function


    //scope------------------------------------
    public function scopeSelect($query, $request)
    {
        return $query->when($request->category, function ($q) use ($request) {
            return $q->whereHas('categories', function ($qu) use ($request) {

                return
                    $qu->where('category_id', $request->category);
            });
        });
    } //-- end select scope


}//-- end model
