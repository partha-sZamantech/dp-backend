<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Epaper extends Model
{
    protected $connection = 'mysql';

    public function pages()
    {
        return $this->hasMany(EpaperPage::class);
    }
}
