<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    protected $connection = 'mysql';

    public function pages()
    {
        return $this->hasMany(MagazinePage::class);
    }
}
