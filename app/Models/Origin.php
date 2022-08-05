<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Origin extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'origin_name',
        'origin_address',
        'origin_phone',
        'origin_notes'
    ];
    use HasFactory;
}
