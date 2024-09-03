<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Auth;

class Users extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      

        return [
            'id' => encode($this->id),
            'username' => $this->username,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'profile_picture_path' => asset("uploads/profile/"),
            'profile_picture' => ($this->picture) ? $this->picture : 'profile-icon.png',
            'status' => $this->status,
            'role' => $this->role,
            'address' => $this->address,
            'zipcode' => $this->zipcode,
            'phone' => $this->phone,
            'passkey' => $this->passkey,
            'dns' => $this->dns,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
