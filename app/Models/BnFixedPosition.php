<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnFixedPosition extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'bn_position_fixed';
}
