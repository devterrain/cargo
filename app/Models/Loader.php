<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loader extends Model
{
    protected $fillable = [
        'loader_num',
        'equipment_type',
        'type',
        'model',
        'loader_notes',
        'shiping_contractor_id'
    ];
    use HasFactory;
    use SoftDeletes;
    public function shipingcontractor()
    {
        return $this->belongsTo(shipingcontractor::class, 'shiping_contractor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
