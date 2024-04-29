<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicles extends Model
{
    use HasFactory;
    protected $guarded = [];
    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::generate(4);
    //     });
    // }
    public function vendors()
    {
        return $this->belongsTo(Vendors::class, 'vendor_id');
    }
    public function carInoutTime()
    {
        return $this->hasMany(carInoutTime::class, 'vehicles_id');
    }
    public function vehicleAllocation()
    {
        return $this->hasMany(VehicleAllocation::class, 'vehicles_id');
    }
}
