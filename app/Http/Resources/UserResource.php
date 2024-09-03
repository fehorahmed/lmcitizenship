<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'father_name' => $this->father_name ?? '',
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role == 2 ? 'Admin' : 'Super Admin',
            'profile_photo_path' => $this->profile_photo_path ? asset($this->profile_photo_path) : '',
            'date_of_birth' => $this->date_of_birth ?? '',
            'nid' => $this->nid ?? '',
            'profession' => $this->profession->name ?? '',
            'designation' => $this->designation ?? '',
            'permanent_division' => $this->perDivision->name ?? '',
            'permanent_district' => $this->perDistrict->name ?? '',
            'permanent_upazila' => $this->perUpazila->name ?? '',
            'permanent_union' => $this->perUnion->name ?? '',
            'permanent_ward_no' => $this->per_ward_no ?? '',
            'permanent_address' => $this->per_address ?? '',


            'office_phone' => $this->off_phone ?? '',
            'office_division_id' => $this->officeDivision->name ?? '',
            'office_district_id' => $this->officeDistrict->name ?? '',
            'office_address' => $this->off_address ?? '',

            'registration_status' => $this->registration_status ?? '',
        ];
    }
}
