<?php

namespace App\Models;

use App\Http\Controllers\ProductController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];
    public function product()
    {
        return $this->hasMany(Product::class, 'product_id' , 'id');
    }
    use HasFactory;
}
