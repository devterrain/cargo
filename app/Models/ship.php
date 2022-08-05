<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ship extends Model
{
    protected $fillable = [
        'ship_name',
        'country',
        'gate_number',
        'ship_dimensions',
        'ship_capacity'
    ];
    protected function shipname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }
    use HasFactory;
}
