<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;

    public function subMenu(){
        return $this->hasMany(MainMenu::class,'main_menu_id','id');
    }
    public function mainMenu(){
        return $this->belongsTo(MainMenu::class,'main_menu_id');
    }
}
