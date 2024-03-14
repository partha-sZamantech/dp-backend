<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnCategory extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_categories';
    protected $primaryKey = 'cat_id';

    public function subcategory(){
        return $this->hasMany('App\Models\EnSubcategory', 'cat_id', 'cat_id')->with('content');
    }

    public function contents(){
        return $this->hasMany('App\Models\EnContent', 'cat_id', 'cat_id')->with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }

}
