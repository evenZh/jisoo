<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';

    public function getFullAddressAttribute()
    {
        return "{$this->province}{$this->city}{$this->district}{$this->detail}";
    }
}
