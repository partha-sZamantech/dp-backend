<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnVideoPosition extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'position_id';
    protected $table = 'bn_video_positions';
}
