<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoAlbumPosition extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'position_id';
    protected $table = 'p_album_positions';
}
