<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnVideoCategory extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bn_video_categories';

    public function contents(){
        return $this->hasMany('App\Models\BnContent', 'cat_id', 'cat_id')->with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }
}
