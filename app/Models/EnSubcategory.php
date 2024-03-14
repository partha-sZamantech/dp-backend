<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnSubcategory extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_subcategories';
    protected $primaryKey = 'subcat_id';

    public function category(){
        return $this->belongsTo('App\Models\EnCategory', 'cat_id', 'cat_id');
    }

    public function contents(){
        return $this->hasMany('App\Models\EnContent', 'subcat_id', 'subcat_id')->with('category', 'subcategory', 'comments')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }
}
