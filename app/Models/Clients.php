<?php

namespace App\Models;

use Webpatser\Uuid\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });

        // self::creating(function ($model) {
        //     $model->allocation_number = (string) Uuid::generate(4);
        // });
    }
    public  function users()
    {
        return $this->belongsToMany(User::class, 'client_alloctions', 'user_id', 'clients_id');
    }

    public function carInoutTime()
    {
        return $this->belongsTo(carInoutTime::class, 'clients_id');
    }

    public function locations()
    {
        return $this->hasMany(ClientLocation::class);
    }
}
