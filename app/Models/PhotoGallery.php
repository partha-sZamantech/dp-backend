<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{

    protected $connection = 'mysql';
    protected $table = 'p_galleries';
    protected $primaryKey = 'id';
    use HasFactory;
}
