<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PolicyDetail extends Model
{
    protected $guarded = [];


    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_id')->withTrashed();
    }
    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id')->withTrashed();
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function shiptrip()
    {
        return $this->belongsTo(ShipTrip::class, 'shiptrip_id')->withTrashed();
    }
    public function scale_user1()
    {
        return $this->belongsTo(User::class, 'scale1_user_id', 'id');
    }
    public function scale_user2()
    {
        return $this->belongsTo(User::class, 'scale2_user_id', 'id');
    }
    public function shipping_user1()
    {
        return $this->belongsTo(User::class, 'shipping1_user_id', 'id');
    }
    public function shipping_user2()
    {
        return $this->belongsTo(User::class, 'shipping2_user_id', 'id');
    }
    public function loader()
    {
        return $this->BelongsTo(Loader::class, 'loader_id', 'id')->withTrashed();
    }
    public function loader2()
    {
        return $this->BelongsTo(Loader::class, 'loader2_id', 'id')->withTrashed();
    }
    public function convair()
    {
        return $this->belongsTo(Convair::class, 'convair_id', 'id')->withTrashed();
    }
    public function loaderoperator()
    {
        return $this->belongsTo(Operator::class, 'loader_operator_id', 'id')->withTrashed();
    }
    public function loaderoperator2()
    {
        return $this->belongsTo(Operator::class, 'loader2_operator_id', 'id')->withTrashed();
    }
    public function convairoperator()
    {
        return $this->belongsTo(Operator::class, 'convair_operator_id', 'id')->withTrashed();
    }
    use HasFactory;
}
