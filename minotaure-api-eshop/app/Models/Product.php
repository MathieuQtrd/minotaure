<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'image',
        'description',
        'stock',
        'price',
    ];

    protected $casts = [
        'hiring_date' => 'date',        
    ];

    public function category()
    {
        // relation ManyToOne
        return $this->belongsTo(Category::class);
    }
}
