<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $gaurded = [];

    //this belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
