<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diposit extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

     public function property(){
        return $this->belongsTo(Property::class);
    }


     public function installment(){
        return $this->belongsTo(Installment::class);
    }
}
