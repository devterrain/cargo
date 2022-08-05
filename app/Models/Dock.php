<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dock extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function port()
    {
        return $this->belongsTo(port::class, 'port_id', 'id');
    }
}
