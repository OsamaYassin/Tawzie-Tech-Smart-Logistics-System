<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materials extends Model
{
    protected  $table = 'tbl_materail';

    protected $fillable = [
        'id', 'name', 'price' , 'quantity','code' , 'type','created_at','updated_at'
    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(   'id', 'name', 'price', 'quantity','code' ,'type', 'created_at','updated_at'
        );
    }



 


}
