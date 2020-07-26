<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class StoreController extends Controller
{

    use DashboardTrait;


    public function __construct()
    {
        $this->middleware('permission:*_stores');
        $this->middleware('permission:create_stores')->only(['create', 'store']);
        $this->middleware('permission:update_stores')->only(['edit', 'update']);
        $this->middleware('permission:delete_stores')->only('destroy');
    } //-- end construct function


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $stores = Store::withTranslation()->with('categories')->withCount('categories')->whereTranslationLike('name', "%$request->search%")->latest()->paginate(5);


        return view('dashboard.store.index', compact('stores'));
    } // end index function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.store.create', compact('categories'));
    } //-- end create function

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ar.*'          =>  ['required', 'unique:store_translations,name', 'string', 'min:3', 'max:20'],
            'en.*'          =>  ['required', 'unique:store_translations,name', 'string', 'min:3', 'max:20'],
            'rating'        =>  ['required'],
            'image'         =>  ['required', 'mimes:jpg,jpeg,bmp,png', 'dimensions:min_width=50,min_height=50', 'image'],
        ]);

        //-- make request data
        $request_data = $request->except(['image', '_method', '_token']);


        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->storeImage('store', $request);

        // create category 
        $store = Store::create($request_data);

        if ($request->categories)
            $store->categories()->attach($request->categories);

        // redirect page
        return redirect()->route('dashboard.store.index')->with('success', __('site.success_add'));
    } //-- end store


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {

        $categories = Category::all();
        return view('dashboard.store.edit', compact('store', 'categories'));
    } //-- ebd edit function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {

        //   dd($request->all());
        $request->validate([
            'ar.*'          =>  ['required', Rule::unique('store_translations')->ignore($store->id, 'store_id'), 'string', 'min:3', 'max:20'],
            'en.*'          =>  ['required',  Rule::unique('store_translations')->ignore($store->id, 'store_id'), 'string', 'min:3', 'max:20'],
            'rating'        =>  ['required'],
            'image'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png', 'dimensions:min_width=50,min_height=50', 'image'],
        ]);

        //-- make request data
        $request_data = $request->except(['image', '_method', '_token']);


        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->checkImage('store', $request, $store);


        // edit Store 
        $store->update($request_data);


        $store->categories()->sync($request->categories);

        // redirect page
        return redirect()->route('dashboard.store.index')->with('success', __('site.success_edit'));
    } //-- end update function

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if (request()->ajax()) {
            //remove the image
            if ($store->image)
                Storage::disk('image')->delete('upload/store/image/' . $store->image);

            // remove the store
            $store->delete();
            return response(['msg' => 'success delete category', 'status' => 'success']);
        }
        return response(['msg' => 'failed delete category', 'status' => 'failed']);
    } //-- end delete function   
}
