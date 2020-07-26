<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'country', 'city', 'address', 'phone_number', 'postal_code', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // helper function---------------------------------------------
    public function getNameImage()
    {
        return $this->image;
    } //-- end get name image

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPathImage()
    {
        return asset('public\images\upload\user\image\\' . $this->image);
    } //-- end get path function


    // relation ------------------------------------------------------

    public function ratings()
    {

        return $this->hasMany(Rating::class);
    } //-- end rating function


    public function orders()
    {

        return $this->hasMany(Order::class);
    } //-- end orders function

    public function products()
    {

        return $this->belongsToMany(Product::class, 'user_product')->withPivot('quantity')->withPivot('total_price');
    } //-- end product function

    // scope ------------------------------------------------------
    public function scopeWhereRoleIs($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            return $q->whereIn('name', (array) $role);
        });
    } //-- end where role is function

    public function scopeWhereRoleIsNot($query, $role)
    {
        return $query->whereHas('roles', function ($q) use ($role) {
            return $q->whereNotIn('name', (array) $role);
        });
    } //-- end where role is not 

    public function scopeWhenSearch($query, $request)
    {

        return $query->when($request->search, function ($q) use ($request) {
            return $q
                ->where('first_name', 'like', "%$request->search%")
                ->orWhere('last_name', 'like', "%$request->search%")
                ->orWhere('email', 'like', "$request->search")
                ->orWhere('country', 'like', "%$request->search%");
        });
    } //-- end when search function


    public function scopeWhereSelectPerm($query, $request)
    {
        return $query->when($request->permissions, function ($q) use ($request) {

            return $q->whereHas('permissions', function ($qu) use ($request) {

                return $qu->whereIn('name', $request->permissions);
            });
        });
    } //-- end scopeWhereSelectPerm function
}
