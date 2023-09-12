<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebinarImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'webinar_id', 'image'
    ];
    
}
