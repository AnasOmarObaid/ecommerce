<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Color;
use App\ProductImages;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{

    use DashboardTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products   =   Product::withTranslation()->with('category')->whenSelect($request)->whereTranslationLike('name', "%$request->search%")->latest()->paginate(6);
        $categories = Category::all();
        return view('dashboard.Product.index', compact('products', 'categories'));
    } //-- end index function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =   Category::all();
        $sizes     =   Size::all();
        $colors     = Color::all();
        return view('dashboard.product.create', compact('categories', 'sizes', 'colors'));
    } //-- end create function

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = [
            'category_id'       =>  ['required'],
            'poster'         =>  ['required', 'mimes:jpg,jpeg,bmp,png',  'image'],
            'images.*'        =>  ['required', 'mimes:jpg,jpeg,bmp,png',  'image'],
            'purchase_price'    =>  ['required'],
            'curet_sale_price'  =>  ['required'],
            'stoke'             =>  ['required'],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', 'string', 'min:2', 'max:2000', 'unique:product_translations,name']];
            $rules += [$locale . '.description' => ['required', 'min:5', 'max:3000']];
            $rules += [$locale . '.raw' => ['nullable', 'string']];
        } //-- end foreach

        // validate request
        $request->validate($rules);
        $request_validate = $request->except(['_method', '_token', 'poster', 'images']);
        $request_validate['product_number'] =  substr(sha1(rand()), 0, 15);
        $request_validate['user_id'] = auth()->user()->id;

        // rename poster image
        if ($request->hasFile('poster'))
            $request_validate['poster'] = $this->storeImage('product_poster', $request);

        // create category 
        $product =  Product::create($request_validate);

        // store image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '.' . $request->images[$index]->getClientOriginalName();
                request()->images[$index]->move(base_path("public\images\upload\product\image\productImage"), $imageName);
                ProductImages::create([
                    'product_id'    =>  $product->id,
                    'image'         =>  $imageName,
                ]);
            } //-- end foreach
        } //-- end store image

        // put the sizes on the product
        if ($request->get('sizes'))
            $product->sizes()->attach($request->get('sizes'));

        // put the sizes on the product
        if ($request->get('colors'))
            $product->colors()->attach($request->get('colors'));

        // redirect page
        return redirect()->route('dashboard.product.index')->with('success', __('site.success_add'));
    } //-- end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories =   Category::all();
        $sizes     =   Size::all();
        $colors     = Color::all();

        return view('dashboard.product.edit', compact('product', 'categories', 'sizes', 'colors'));
    } //-- end edit function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $rules = [
            'category_id'       =>  ['required'],
            'poster'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png', 'image'],
            'images.*'        =>  ['nullable', 'mimes:jpg,jpeg,bmp,png', 'image'],
            'purchase_price'    =>  ['required'],
            'curet_sale_price'  =>  ['required'],
            'stoke'             =>  ['required'],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', 'string', 'min:2', 'max:20']];
            $rules += [$locale . '.description' => ['required', 'min:5', 'max:3000']];
            $rules += [$locale . '.raw' => ['nullable', 'string']];
        } //-- end foreach

        // validate request
        $request->validate($rules);
        $request_validate = $request->except(['_method', '_token', 'poster', 'images']);

        // rename poster image
        if ($request->hasFile('poster'))
            $request_validate['poster'] = $this->checkImage('product', $request, $product);


        // store image
        if ($request->hasFile('images')) {

            // remove the image then store new
            foreach ($product->images as $image) {
                // Storage::disk('image')->delete('product\image\productImage\\' . $image->image);

                $image->delete();
            } //-- end foreach for product

            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '.' . $request->images[$index]->getClientOriginalName();
                request()->images[$index]->move(base_path("public\images\upload\product\image\productImage\\"), $imageName);
                ProductImages::create([
                    'product_id'    =>  $product->id,
                    'image'         =>  $imageName,
                ]);
            } //-- end foreach
        } //-- end store image

        // put the sizes on the product
        if ($request->get('sizes'))
            $product->sizes()->sync($request->get('sizes'));

        // put the sizes on the product
        if ($request->get('colors'))
            $product->colors()->sync($request->get('colors'));

        // redirect page
        $product->update($request_validate);
        return redirect()->route('dashboard.product.index')->with('success', __('site.success_edit'));
    } //-- end update product

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (request()->ajax()) {

            //remove the image
            if ($product->poster)
                Storage::disk('image')->delete('upload/product/image/poster/' . $product->poster);

            // remove the product
            $product->delete();
            return response(['msg' => 'success delete product', 'status' => 'success']);
        }
        return response(['msg' => 'failed delete product', 'status' => 'failed']);
    } //-- end destroy function
}//-- end of controller
