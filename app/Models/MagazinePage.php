<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MagazinePage extends Model
{
    protected $connection = 'mysql';

    public function magazine(){
        return $this->belongsTo(Magazine::class);
    }
}
