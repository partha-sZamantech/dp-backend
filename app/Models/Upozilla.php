<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upozilla extends Model
{
    protected $primaryKey = 'upozilla_id';
    protected $fillable = [
        'district_id',
        'division_id',
        'upozilla_name',
        'upozilla_name_bn',
        'upozilla_slug',
        'deletable',
        'created_at',
        'updated_at'
    ];

    public function district(){
        return $this->belongsTo('App\Models\District', 'district_id', 'district_id');
    }
}


