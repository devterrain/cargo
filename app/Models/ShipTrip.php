<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipTrip extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        'active' => 'boolean'
    ];
    protected $guarded = [];
    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function($model){
    //         $model->full_number->
    //     });
    // }
    public function ship()
    {
        return $this->belongsTo(ship::class, 'ship_id', 'id');
    }
    public function dock()
    {
        return $this->belongsTo(dock::class, 'dock_id', 'id');
    }
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
