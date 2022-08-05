<?php

namespace App\Models;

use App\Http\Controllers\CargoController;
use App\Http\Controllers\CategoryController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function cargo()
    {
        return $this->hasMany(Cargo::class, 'cargo_id');
    }
}
