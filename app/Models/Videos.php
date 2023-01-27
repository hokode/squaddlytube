<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'title', 'path', 'user_id', 'image_path', 'description'
    ];

    protected $dates = [
        'converted_for_downloading_at',
        'converted_for_streaming_at',
    ];
}
