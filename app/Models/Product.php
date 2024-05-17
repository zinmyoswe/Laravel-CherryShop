<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'productid','productname', 'category', 'gender', 'price', 'stock', 'description', 'image', 'images', 'video',
    ];

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function colors()
    {
       
        return $this->belongsToMany(Color::class)->withPivot('image')->withTimestamps();
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
