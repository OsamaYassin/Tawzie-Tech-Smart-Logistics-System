<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCaptin  extends Model
{
    protected  $table = 'tbl_delivery_captin';

    protected $fillable = [
        'id', 'name', 'phone_one' , 'phone_two', 'address' ,'created_at','updated_at'
    ];

   // protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id', 'name', 'phone_one' , 'phone_two', 'address' ,'created_at','updated_at'
        );
    }

    public function ordersTacke()
    {
        return $this->hasMany('App\Models\Orders' );
    }

}
