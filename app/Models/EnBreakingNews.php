<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnBreakingNews extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_breaking_news';

    protected $casts = [
      'expired_time' => 'datetime',
    ];
}
