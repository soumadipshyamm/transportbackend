<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class Reporting extends Model
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
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function formVehical()
    {
        return $this->belongsTo(Vehicles::class, 'form_vehicle_id');
    }
    public function toVehical()
    {
        return $this->belongsTo(Vehicles::class, 'to_vehicle_id');
    }
}
