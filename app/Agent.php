<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $guarded = [];

    protected $table = 'agent';

    public function customer()
    {
        return $this->hasMany(Customer::class, 'referral_id', 'id');
    }
}
