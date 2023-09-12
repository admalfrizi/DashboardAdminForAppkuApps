<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'titleKelas', 'stage', 'jmlhVideo'
    ];  

    public function categoryKelas()
    {
        return $this->belongsTo(KelasCategory::class, 'category_id', 'id');
    }

    public function imageGalleries()
    {
        return $this->hasMany(KelasImages::class, 'kelas_id', 'id');
    }
}
