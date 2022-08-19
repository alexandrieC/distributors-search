<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name', 'address', 'email', 'domain', 'status', 'phone'];
    public $timestamps = false;

    public function region(){
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
}
