<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleAllocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Clients::class, 'clients_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicles_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function carInoutTime()
    {
        return $this->hasMany(carInoutTime::class, 'vehicle_allocations_id');
    }
    // public function getStatusAttribute($value)
    // {
    //     return $value == 1 ? 'active' : 'inactive';
    // }
    public function getAllocationAttribute($value)
    {
        return $value == 1 ? 'Indent/Daily' : 'Monthly';
    }
}
