<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BnContent extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'content_id';

    public function category(){
        return $this->belongsTo('App\Models\BnCategory', 'cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug')
            ->where('cat_type', 1);
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\BnSubcategory', 'subcat_id', 'subcat_id')
            ->select('subcat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug');
    }

    public function specialCategory(){
        return $this->belongsTo('App\Models\BnCategory', 'special_cat_id', 'cat_id')
            ->select('cat_id', 'cat_name', 'cat_name_bn', 'cat_slug')
            ->where('cat_type', 2);
    }

    public function uploader() {
        return $this->belongsTo('App\Models\User', 'uploader_id', 'id');
    }

    public function author(){
        return $this->belongsTo('App\Models\BnAuthor', 'author_slugs', 'author_slug');
    }
}
