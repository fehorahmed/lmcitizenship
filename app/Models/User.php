<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    // use HasProfilePhoto;
    use Notifiable;
    // use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin()
    {
        return $this->role == 3;
    }

    public function isMember()
    {
        return $this->role == 1;
    }

    public function isDigitalCenter()
    {
        return $this->role == 2;
    }
    public function isCommissioner()
    {
        return $this->role == 4;
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
        return $this->belongsTo(Upazila::class, 'sub_district_id');
    }
    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    public function perDivision()
    {
        return $this->belongsTo(Division::class, 'per_division_id');
    }
    public function perDistrict()
    {
        return $this->belongsTo(District::class, 'per_district_id');
    }
    public function perUpazila()
    {
        return $this->belongsTo(Upazila::class, 'per_sub_district_id');
    }
    public function perUnion()
    {
        return $this->belongsTo(Union::class, 'per_union_id');
    }
    public function perWard()
    {
        return $this->belongsTo(Ward::class, 'per_ward_id');
    }
    public function perMoholla()
    {
        return $this->belongsTo(Moholla::class, 'per_moholla_id');
    }
    public function officeDivision()
    {
        return $this->belongsTo(Division::class, 'off_division_id');
    }
    public function officeDistrict()
    {
        return $this->belongsTo(District::class, 'off_district_id');
    }
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public function birthday()
    {
        return Carbon::parse($this->date_of_birth)->format('d/m/Y');
    }
}
