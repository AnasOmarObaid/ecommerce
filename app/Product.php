<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Category;
use App\ProductImages;
use App\Color;

class Product extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description', 'tag', 'pro_ins', 'raw', 'style'];
    public $fillable = ['category_id', 'user_id', 'product_number', 'poster', 'size', 'purchase_price', 'curet_sale_price', 'gender', 'number_sale', 'new_sale_price', 'stoke'];


    // helper function


    public function getNamePoster()
    {
        return $this->poster;
    } //-- end get poster function

    public function finalPrice()
    {

        if ($this->new_sale_price)
            return $this->new_sale_price;

        return $this->curet_sale_price;
    } //-- end final price

    public function getPoster()
    {
        return asset('public\images\upload\product\image\poster\\' . $this->poster);
    } //-- end get poster function

    public function profit()
    {
        $sale = 0;

        if ($this->new_sale_price) {
            $sale = $this->new_sale_price;
        } else {
            $sale = $this->curet_sale_price;
        }

        $profit = $sale - $this->purchase_price;

        $profit_present = $profit * 100 /  $this->purchase_price;
        return number_format($profit_present, 1);
    } //-- end profit function

    // relationship--------------------------------------------------------
    public function images()
    {

        return $this->hasMany(ProductImages::class);
    } //-- end images

    public function category()
    {

        return $this->belongsTo(Category::class);
    } //-- end category function

    public function user()
    {

        return $this->belongsTo(User::class);
    } //-- end user function

    public function colors()
    {
        return $this->belongsToMany(Color::class);
    } //-- end colors function

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    } //-- end size function


    public function ratings()
    {
        return $this->hasMany(Rating::class);
    } //-- end ratings function

    public function orders()
    {

        return $this->belongsToMany(Order::class, 'product_order');
    } //-- end orders function

    public function users()
    {

        return $this->belongsToMany(User::class, 'user_product')->withPivot('quantity')->withPivot('total_price');
    } //-- end product function

    // scope-------------------------------------
    public function scopeWhenSelect($query, $request)
    {
        return $query->when($request->category, function ($q) use ($request) {

            return $q->where('category_id', $request->category);
        });
    } //-- end scope search

    public function scopeWhereCategory($query, $product)
    {

        return $query->where('category_id', $product->category->id)->where('id', '!=', $product->id);
    } //-- end where category


    public function scopeSelectCategory($query, $request)
    {
        return $query->when($request->category_id, function ($q) use ($request) {
            return $q->whereHas('category', function ($qu) use ($request) {
                return
                    $qu->where('id', $request->category_id);
            });
        });
    } //-- end select scope
}//-- end product model
