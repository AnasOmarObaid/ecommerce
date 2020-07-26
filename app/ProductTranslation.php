<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'tag', 'pro_ins', 'raw', 'style'];
}//-- end product Translation
