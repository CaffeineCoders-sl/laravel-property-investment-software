<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $guarded = [];

    public function investment(){
        return $this->belongsTo(Investment::class);
    }

    public function disposit(){
        return $this->hasOne(Diposit::class, 'installment_id');
    }
 

}
