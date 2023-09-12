<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'titleWebinar', 
        'description', 
        'freeOrBuy'
    ];
    
    public function imageGalleries()
    {
        return $this->hasMany(WebinarImages::class, 'webinar_id', 'id');
    }
}
