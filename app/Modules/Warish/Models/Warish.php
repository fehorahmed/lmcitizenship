<?php

namespace App\Modules\Warish\Models;

use App\Models\District;
use App\Models\Division;
use App\Models\Moholla;
use App\Models\PostOffice;
use App\Models\Upazila;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warish extends Model
{
    use HasFactory;

    public function details()
    {
        return $this->hasMany(WarishDetail::class);
    }
    public function aplication()
    {
        return $this->hasOne(WarishApplication::class);
    }

    public function moholla(){
        return $this->belongsTo(Moholla::class,'moholla_id');
    }
    public function ward(){
        return $this->belongsTo(Ward::class,'ward_id');
    }
    public function postOffice(){
        return $this->belongsTo(PostOffice::class,'post_office_id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }
}
