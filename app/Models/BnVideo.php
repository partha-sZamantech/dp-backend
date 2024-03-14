<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnVideo extends Model
{
    protected $connection = 'mysql';

    public function category() {
        return $this->belongsTo(BnVideoCategory::class, 'cat_id', 'id');
    }
}
