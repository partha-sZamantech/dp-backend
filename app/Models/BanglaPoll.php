<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanglaPoll extends Model
{
    protected $connection = 'mysqlpoll';
    protected $table = 'bangla_polls';
    protected $primaryKey = 'banglapoll_id';
}
