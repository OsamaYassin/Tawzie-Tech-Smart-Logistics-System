<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donations extends Model
{
    protected  $table = 'donations';

    protected $fillable = [
        'id','type', 'amount', 'discription','benefactor_id', 'created_at','updated_at'
    ];



    public  function scopeSelection($query){

        return $query -> select( 'id','type', 'amount', 'discription','benefactor_id', 'created_at','updated_at'
        );
    }



    //###################### RelationShip ######################
  
}
