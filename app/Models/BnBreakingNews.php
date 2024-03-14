<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnBreakingNews extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bn_breaking_news';

    protected $casts = [
      'expired_time' => 'datetime',
    ];
}
