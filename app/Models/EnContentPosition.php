<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnContentPosition extends Model
{
    protected $connection = 'mysqlen';
    protected $primaryKey = 'position_id';
    protected $table = 'en_content_positions';
}
