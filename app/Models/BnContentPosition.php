<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnContentPosition extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'position_id';
    protected $table = 'bn_content_positions';
}
