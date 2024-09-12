<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;


    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }
    public function commissioner()
    {
        return $this->hasOne(User::class, 'commissioner_ward_id');
    }
}
