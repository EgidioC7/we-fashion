<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'size', 'salePrice', 'image_url', 'reference', 'status_publish', 'status_product', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status_publish', 1);
    }

    public function scopeSold($query)
    {
        return $query->where('status_product', "sold");
    }



}
