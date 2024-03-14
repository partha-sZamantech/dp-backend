<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnTag extends Model
{
    protected $connection = 'mysql';
    protected $table = 'bn_tags';
    protected $primaryKey = 'tag_id';
}
