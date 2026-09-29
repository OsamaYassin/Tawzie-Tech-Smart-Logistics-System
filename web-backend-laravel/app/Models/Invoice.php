<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected  $table = 'invoice';

    protected $fillable = [
        'id','name', 'amount','discription', 'created_at','updated_at'
    ];



    public  function scopeSelection($query){

        return $query -> select('id','name', 'amount', 'discription', 'created_at','updated_at'
        );
    }



    //###################### RelationShip ######################
    

}
