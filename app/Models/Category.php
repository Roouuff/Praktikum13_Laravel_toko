<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Satu Category memiliki banyak Product (One to Many)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}