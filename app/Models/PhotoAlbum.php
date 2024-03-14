<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PhotoAlbum extends Model
{
    protected $connection = 'mysql';
    protected $table = 'p_albums';
    protected $primaryKey = 'album_id';
    protected $guarded = [];

    public function category(){
        return $this->belongsTo('App\Models\PhotoCategory', 'cat_id', 'cat_id');
    }

    public function subcategory(){
        return $this->belongsTo('App\Models\PhotoSubcategory', 'subcat_id', 'subcat_id');
    }

    public function uploader(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAlbumDetailsAttribute($value)
    {
        return unserialize($value);
    }

    public function getFeatureImageAttribute()
    {
        return collect($this->album_details)->where('featureImage', 2)->first();
    }

    public function getPublishedAttribute()
    {
        return fFormatDateEn2Bn(Carbon::parse($this->created_at)->format('d F Y, h:i a'));
    }
}
