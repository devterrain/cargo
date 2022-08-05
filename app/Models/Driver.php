<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Driver extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'driver_name',
        'province',
        'city',
        'driver_address',
        'driver_birthday',
        'class',
        'licence_type',
        'licence_num',
        'identity_num',
        'hiring_date',
        'driver_code',
        'contractor_id',
        'user_id',
        'driver_notes'
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

    use HasFactory;
}
