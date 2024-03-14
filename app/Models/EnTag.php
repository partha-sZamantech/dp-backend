<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnTag extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'en_tags';
    protected $primaryKey = 'tag_id';
}
