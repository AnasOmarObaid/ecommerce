<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:*_users');
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('destroy');
    } //-- end construct function

    use DashboardTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = User::with('roles')->whereRoleIs('client')->whenSearch($request)->latest()->paginate(6);


        return view('dashboard.client.index', compact('clients'));
    } //-- end index function

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.client.create');
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
            'first_name'    =>  ['required', 'string', 'min:2', 'max:20'],
            'last_name'     =>  ['required', 'string', 'min:2', 'max:20'],
            'image'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png', 'dimensions:min_width=50,min_height=50', 'image'],
            'email'         =>  ['required', 'unique:users'],
            'password'      =>  ['required', 'min:4', 'max:20', 'confirmed'],
            'city'          =>  ['nullable', 'string', 'min:3', 'max:30'],
            'country'       =>  ['nullable', 'string'],
            'postal_code'   =>  ['nullable', 'string', 'min:2', 'max:40'],
        ]);

        //-- make request data
        $request_data = $request->except(['password', 'password_confirmation', 'image', 'permissions', '_method', '_token']);
        $request_data['password'] = bcrypt($request->password);

        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->storeImage('user', $request);

        // create user 
        $user = User::create($request_data);


        // attach role and permission to user
        $user->attachRole('client');

        // redirect page
        return redirect()->route('dashboard.client.index')->with('success', __('site.success_add'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('dashboard.client.edit', compact('client'));
    } //-- end edit function

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $client)
    {
        $request->validate([
            'first_name'    =>  ['required', 'string', 'min:2', 'max:20'],
            'last_name'     =>  ['required', 'string', 'min:2', 'max:20'],
            'image'         =>  ['nullable', 'mimes:jpg,jpeg,bmp,png', 'dimensions:min_width=50,min_height=50', 'image'],
            'email'         =>  ['required', Rule::unique('users')->ignore($client->id)],
            'city'          =>  ['nullable', 'string', 'min:3', 'max:30'],
            'country'       =>  ['nullable', 'string'],
            'postal_code'   =>  ['nullable', 'string', 'min:2', 'max:40'],
        ]);

        //-- make request data
        $request_data = $request->except(['password', 'password_confirmation', 'image', 'permissions', '_method', '_token']);
        $request_data['password'] = bcrypt($request->password);

        //-- validate if theres image
        if ($request->file('image'))
            $request_data['image'] = $this->checkImage('user', $request, $client);

        // create user 
        $client->update($request_data);
        // redirect page
        return redirect()->route('dashboard.client.index')->with('success', __('site.success_edit'));
    } //-- end update function

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        if (request()->ajax()) {

            //remove the image
            if ($client->image != 'default.jpg')
                Storage::disk('image')->delete('upload/user/image/' . $client->image);
            // remove the user
            $client->delete();
            return response(['msg' => 'success delete movie', 'status' => 'success']);
        }
        return response(['msg' => 'failed delete movie', 'status' => 'failed']);
    }
}//-- end client controller
