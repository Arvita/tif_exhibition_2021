<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title', 'description', 'picture', 'url', 'product_id'
    ];
}
