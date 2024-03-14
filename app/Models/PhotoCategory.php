<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoCategory extends Model
{
    protected $table = 'p_categories';
    protected $primaryKey = 'cat_id';

    public function subcategory(){
        return $this->hasMany('App\PhotoSubcategory', 'cat_id', 'cat_id');
    }

    public function albums(){
        return $this->hasMany('App\PhotoAlbum', 'cat_id', 'cat_id')->where('deletable', 1)->orderBy('album_id', 'desc');
    }
}
