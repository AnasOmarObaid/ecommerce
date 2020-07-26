<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


trait DashboardTrait
{

    // function to store image just put the object like users... and put the request
    public function storeImage($type, Request $request)
    {
        if ($type == 'user') {
            $imageName = time() . '.' . request()->file('image')->getClientOriginalExtension();
            request()->file('image')->move(base_path("public\images\upload\user\image"), $imageName);
            return $imageName;
        } //-- end if

        if ($type == 'category') {
            $imageName = time() . '.' . request()->file('image')->getClientOriginalExtension();
            request()->file('image')->move(base_path("public\images\upload\category\image"), $imageName);
            return $imageName;
        } //-- end if

        if ($type == 'store') {
            $imageName = time() . '.' . request()->file('image')->getClientOriginalExtension();
            request()->file('image')->move(base_path("public\images\upload\store\image"), $imageName);
            return $imageName;
        } //-- end if

        if ($type == 'product_poster') {
            $imageName = time() . '.' . request()->file('poster')->getClientOriginalExtension();
            request()->file('poster')->move(base_path("public\images\upload\product\image\poster"), $imageName);
            return $imageName;
        } //-- end if


    } //-- end store image type


    // function to check if the user have image before update his image to delete it 
    public function checkImage($type, Request $request, $model)
    {
        if ($type == 'user') {
            // just store the image
            if ($model->image == 'default.jpg') {
                return $this->storeImage('user', $request);
            } //-- end check name image
            // this user has already image and he want to update it so i will to remove it after that call the method to store it
            else {
                Storage::disk('image')->delete('upload/user/image/' . $model->image);
                return $this->storeImage('user', $request);
            }
        } //-- end user type

        if ($type == 'category') {
            Storage::disk('image')->delete('upload\category\image\\' . $model->image);
            return $this->storeImage('category', $request);
        } //-- end user type

        if ($type == 'store') {
            Storage::disk('image')->delete('upload\store\image\\' . $model->image);
            return $this->storeImage('store', $request);
        } //-- end user type

        if ($type == 'product') {
            Storage::disk('image')->delete('upload\product\image\poster\\' . $model->poster);
            return $this->storeImage('product_poster', $request);
        } //-- end user type
    } //-- end check image function

}//-- end dashboard trait
