<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $guarded = [];
    public $timestamps = false;

    // protected $fillable = ['id', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class,'id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
