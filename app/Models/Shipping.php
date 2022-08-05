<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function shiptrip()
    {
        return $this->belongsTo(ShipTrip::class, 'shiptrip_id', 'id');
    }
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function storedist()
    {
        return $this->belongsTo(Store::class, 'store_dist_id', 'id');
    }
    public function loader()
    {
        return $this->belongsTo(Loader::class, 'loader_id', 'id');
    }
    public function convair()
    {
        return $this->belongsTo(convair::class, 'convair_id', 'id');
    }
    public function operator()
    {
        return $this->belongsTo(Operator::class, 'operator_id', 'id');
    }
    public function operatortwo()
    {
        return $this->belongsTo(Operator::class, 'operator2_id', 'id');
    }
    public function loaderoperator()
    {
        return $this->belongsTo(Operator::class, 'loader_operator_id', 'id');
    }
    public function convairoperator()
    {
        return $this->belongsTo(Operator::class, 'convair_operator_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function shipuser()
    {
        return $this->belongsTo(User::class, 'user2_id', 'id');
    }
}
