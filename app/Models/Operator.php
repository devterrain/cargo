<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operator extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function shipingcontractor()
    {
        return $this->belongsTo(ShipingContractor::class, 'shipping_contractor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
