<?php

namespace App\Modules\Warish\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarishApplication extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }
    public function warish(){
        return $this->belongsTo(Warish::class);
    }
}
