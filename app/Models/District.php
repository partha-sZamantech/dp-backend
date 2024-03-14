<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'district_id';

    public function division(){
        return $this->belongsTo('App\Models\Division', 'division_id', 'division_id');
    }
}
