<?php

namespace App\Models;

use App\Modules\Citizenship\Models\Citizenship;
use App\Modules\Warish\Models\WarishApplication;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function citizen(){
        return $this->belongsTo(Citizenship::class,'citizenship_id');
    }
    public function warish(){
        return $this->belongsTo(WarishApplication::class,'warish_application_id');
    }
    public function digitalAcceptBy(){
        return $this->belongsTo(User::class,'digital_accept_by');
    }
}
