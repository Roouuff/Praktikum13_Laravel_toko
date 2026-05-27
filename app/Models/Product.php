<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 
        'name', 
        'description',
        'price', 
        'stock', 
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
        'stock'     => 'integer',
    ];

    /**
     * Setiap Product dimiliki oleh satu Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class);
}
}