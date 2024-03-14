<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnVideoPosition extends Model
{
    protected $connection = 'mysqlen';
    protected $primaryKey = 'position_id';
    protected $table = 'en_video_positions';
}
