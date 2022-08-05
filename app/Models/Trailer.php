<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trailer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'trailer_type',
        'tplate_num',
        'trailer_notes',
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
    use HasFactory;
}
