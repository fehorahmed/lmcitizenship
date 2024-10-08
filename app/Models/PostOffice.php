<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;

    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazila_id');
    }
}
