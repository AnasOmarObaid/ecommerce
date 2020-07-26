<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $fillable = ['color', 'hex_code'];

    public $timestamp = false;
}//-- end model
