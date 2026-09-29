<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceDelivery extends Model
{
    protected  $table = 'tbl_price_deliery';

    protected $fillable = [
        'id', 'name', 'price' , 'created_at','updated_at'
    ];


    public  function scopeSelection($query){

        return $query -> select(   'id', 'name', 'price', 'created_at','updated_at'
        );
    }



   /* public function students()
    {
        return $this->hasMany('App\Models\Students', 'id_alhalga');
    }



    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers', 'id');
    }*/






}
