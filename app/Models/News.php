<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'nameNews', 'descNews'
    ];    

    public function imageGalleries()
    {
        return $this->hasMany(NewsImages::class, 'news_id', 'id');
    }
}
