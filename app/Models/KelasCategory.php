<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "categoryName"
    ];


    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'category_id', 'id');
    }
}
