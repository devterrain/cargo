<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convair extends Model
{
    protected $fillable = [
            'convair_num',
            'convair_power',
            'convair_notes',
            'type',
            'length',
            'shiping_contractor_id',
            'user_id'
    ];
    public function shipingcontractor()
    {
        return $this->belongsTo(shipingcontractor::class, 'shiping_contractor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    use HasFactory;
}
