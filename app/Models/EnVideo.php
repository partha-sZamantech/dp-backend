<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnVideo extends Model
{
    protected $connection = 'mysqlen';

    public function category() {
        return $this->belongsTo(EnVideoCategory::class, 'cat_id', 'id');
    }
}
