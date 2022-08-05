<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id')->withTrashed();
    }
    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id')->withTrashed();
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id')->withTrashed();
    }
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id');
    }
    public function contractor()
    {
        return $this->belongsTo(contractor::class, 'contractor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
