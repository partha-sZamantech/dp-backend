<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnSiteSettings extends Model
{
    protected $connection = 'mysqlen';
    protected $table = 'site_settings';
}
