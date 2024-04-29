<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLocation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function subLocations()
    {
        return $this->hasMany(ClientSubLocation::class);
    }
}
