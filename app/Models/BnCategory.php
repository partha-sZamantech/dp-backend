<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BnSubcategory;

class BnCategory extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bn_categories';
    protected $primaryKey = 'cat_id';

    public function subcategory(){
        return $this->hasMany('App\Models\BnSubcategory', 'cat_id', 'cat_id')->with('contents');
    }

    public function subCategories(){
        return $this->hasMany(BnSubcategory::class, 'cat_id', 'cat_id')
                    ->select('subcat_id', 'subcat_name', 'subcat_name_bn', 'subcat_slug');
    }
    public function subcat(){
        return $this->hasMany(BnSubcategory::class, 'cat_id', 'cat_id');
    }

    public function contents(){
        return $this->hasMany('App\Models\BnContent', 'cat_id', 'cat_id')->with('category', 'subcategory')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }
}
