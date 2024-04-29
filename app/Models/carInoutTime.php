<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class carInoutTime extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function clients()
    {
        return $this->belongsTo(Clients::class, 'clients_id');
    }

    public function vehical()
    {
        return $this->belongsTo(Vehicles::class, 'vehicles_id');
    }
    public function helpers()
    {
        return $this->belongsTo(Helper::class, 'helper_id');
    }
    public function vehicleAllocationsId()
    {
        return $this->belongsTo(VehicleAllocation::class, 'vehicle_allocations_id');
    }
}
// vehicles_id
// clients_id
// in_time
// out_time
