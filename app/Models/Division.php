<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'division_id';

    public function contents(){
        return $this->hasMany('App\Models\BnContent', 'division_id', 'division_id')->with('category', 'subcategory', 'comments')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }

    public function enContents(){
        return $this->hasMany('App\Models\EnContent', 'division_id', 'division_id')->with('category', 'subcategory', 'comments')->where('status', 1)->where('deletable', 1)->orderBy('content_id', 'desc');
    }
}
