<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contractor extends Model
{
    protected $fillable = [
        'contractor_name',
        'contractor_notes',
        'created_by'
    ];
    use HasFactory;
}
