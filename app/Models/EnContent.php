<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnContent extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_contents';
    protected $primaryKey = 'content_id';

    public function category(){
        return $this->belongsTo('App\Models\EnCategory', 'cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name', 'cat_slug')
            ->where('cat_type', 1);
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\EnSubcategory', 'subcat_id', 'subcat_id')
            ->select('subcat_id', 'subcat_name', 'subcat_name', 'subcat_slug');
    }

    public function specialCategory(){
        return $this->belongsTo('App\Models\EnCategory', 'special_cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name', 'cat_slug')
            ->where('cat_type', 2);
    }

    public function uploader() {
        return $this->belongsTo('App\Models\User', 'uploader_id', 'id');
    }
}
