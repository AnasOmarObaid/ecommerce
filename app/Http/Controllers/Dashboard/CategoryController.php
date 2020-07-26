<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:*_categories');
        $this->middleware('permission:create_categories')->only(['create', 'store']);
        $this->middleware('permission:update_categories')->only(['edit', 'update']);
        $this->middleware('permission:delete_categories')->only('destroy');
    } //-- end construct function

    use DashboardTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::withTranslation()->withCount('products')->whereTranslationLike('name', "%$request->search%")->latest()->paginate();
        return view('dashboard.category.index', compact('categories'));
    } //-- end index function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.category.create');
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
            'ar.*'          =>  ['required', 'unique:category_translations,name', 'string', 'min:3', 'max:20'],
            'en.*'          =>  ['required', 'unique:category_translations,name', 'string', 'min:3', 'max:20'],
            'image'         =>  ['required', 'mimes:jpg,jpeg,bmp,png,svg', 'dimensions:min_width=50,min_height=50', 'image'],
        ]);

        //-- make request data
        $request_data = $request->except(['image', '_method', '_token']);

        //-- add user to category
        $request_data['user_id'] = auth()->user()->id;
        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->storeImage('category', $request);

        // create category 
        Category::create($request_data);

        // redirect page
        return redirect()->route('dashboard.category.index')->with('success', __('site.success_add'));
    } //-- end store function


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    } //-- end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'ar.*'          =>  ['required', 'string',  Rule::unique('category_translations')->ignore($category->id, 'category_id'), 'min:2', 'max:20'],
            'en.*'          =>  ['required', 'string',  Rule::unique('category_translations')->ignore($category->id, 'category_id'), 'min:2', 'max:20'],
            'image'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png, svg', 'dimensions:min_width=50,min_height=50', 'image'],
        ]);

        //-- make request data
        $request_data = $request->except(['image', '_method', '_token']);

        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->checkImage('category', $request, $category);

        // create category 
        $category->update($request_data);

        // redirect page
        return redirect()->route('dashboard.category.index')->with('success', __('site.success_add'));
    } //-- end update function

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (request()->ajax()) {

            //remove the image
            if ($category->image)
                Storage::disk('image')->delete('upload/category/image/' . $category->image);

            // remove the category
            $category->delete();
            return response(['msg' => 'success delete category', 'status' => 'success']);
        }
        return response(['msg' => 'failed delete category', 'status' => 'failed']);
    } //-- end delete function
}//-- end Category Controller
