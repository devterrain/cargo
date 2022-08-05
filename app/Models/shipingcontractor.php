<?php

namespace App\Models;

use App\Http\Controllers\LoaderController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipingContractor extends Model
{
    protected $fillable = [
        'SCName',
        'SCName_notes',
        'created_by'
    ];
    // public function Loader()
    // {
    //     return $this->hasMany(Loader::class);
    // }
    use HasFactory;
}
