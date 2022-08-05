<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'type',
        'model',
        'manufacturer',
        'plate_num',
        'chasset_num',
        'engine_num',
        'entry_date',
        'contractor_id',
        'user_id'
    ];
    protected $dates = ['deleted_at'];
    public function contractor()
    {
        return $this->belongsTo(contractor::class, 'contractor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function shipping()
    {
        return $this->belongsToMany(Shipping::class, 'shipping_id')->withPivot('shipping_id');
    }
    use HasFactory;
}
