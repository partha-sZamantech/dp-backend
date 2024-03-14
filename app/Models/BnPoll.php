<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BnPoll extends Model
{
    protected $connection = 'mysqlpoll';
    protected $table = 'bn_polls';
    protected $primaryKey = 'poll_id';
}
