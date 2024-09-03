<?php

namespace App\Modules\Citizenship\Models;

use App\Models\District;
use App\Models\Division;
use App\Models\Moholla;
use App\Models\PostOffice;
use App\Models\TransactionLog;
use App\Models\Upazila;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizenship extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'dc_id', 'name', 'father', 'husband', 'mother', 'bc_no', 'nid','address', 'moholla_id', 'ward_id','union_id','post_office_id',
        'upazila_id', 'district_id', 'division_id', 'payment_method', 'amount', 'rate', 'dc_rate', 'payment_info', 'payment_date',
        'nid_info', 'citizenship_info', 'nid_file', 'citizenship_file', 'photo_file', 'status',
        'remarks', 'sort_by', 'is_active', 'create_by', 'modified_by'
    ];
    // 'division_id' =>  $user->per_division_id,
    // 'district_id' =>  $user->per_district_id,
    // 'upazila_id' =>  $user->per_sub_district_id,
    // 'union_id' =>  $user->per_union_id,
    // 'ward_id' =>  $user->per_ward_id,
    // 'moholla_id' =>  $user->per_moholla_id,
    // 'post_office_id' =>  $user->per_post_office_id,
    // 'address' =>  $user->per_address,

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function transactionLog(){
        return $this->hasOne(TransactionLog::class,'citizenship_id','id');
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
