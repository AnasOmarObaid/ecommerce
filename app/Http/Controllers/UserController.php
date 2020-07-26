<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Dashboard\DashboardTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use DashboardTrait;

    public function __construct()
    {
        $this->middleware('auth');
    } //-- end 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    } //-- end index


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'    =>  ['required', 'string', 'min:2', 'max:20'],
            'last_name'     =>  ['required', 'string', 'min:2', 'max:20'],
            'image'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png, svg',  'image'],
            'email'         =>  ['required', Rule::unique('users')->ignore(auth()->user()->id)],
            'city'          =>  ['nullable', 'string', 'min:3', 'max:30'],
            'country'       =>  ['nullable', 'string'],
            'postal_code'   =>  ['nullable', 'string', 'min:2', 'max:40'],

        ]);
        //-- make request data
        $request_data = $request->except(['image', '_method', '_token']);

        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->checkImage('user', $request, auth()->user());

        // create user 
        auth()->user()->update($request_data);

        // redirect page
        return $request->type == 'type' ? redirect()->route('front.pay.index') : redirect()->back()->with('success', __('site.success_edit'));
    } //-- end update function

    public function userData()
    {


        return view('user.dataUser');
    } //-- end user data function
}
