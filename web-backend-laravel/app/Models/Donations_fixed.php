<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donations_fixed extends Model
{
    protected  $table = 'donations_fixed';

    protected $fillable = [
        'id','benefactor_id', 'amount','donation_status','donation_date','created_at','updated_at'
    ];



    public  function scopeSelection($query){

        return $query -> select(   'id','benefactor_id', 'amount','donation_status','donation_date','created_at','updated_at'
        );
    }



    //###################### RelationShip ######################
    public function benefactors()
    {
        return $this->hasMany('App\Models\Benefactor', 'don_id');
    }


 

}
