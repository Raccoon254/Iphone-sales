<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'link', 'image_url', 'type'];

    const TYPES = [
        'top_right' => 'Top Right',
        'bottom_right' => 'Bottom Right',
        'main' => 'Main',
    ];

}

