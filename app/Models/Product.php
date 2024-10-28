<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'stock',      // Added stock
        'image',      // Added image
        'category_id', // Assuming a category relation
    ];

    // Define the relationship to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
