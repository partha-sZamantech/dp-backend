<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnSiteSettings extends Model
{
    protected $connection = 'mysql';
    protected $table = 'site_settings';
}
