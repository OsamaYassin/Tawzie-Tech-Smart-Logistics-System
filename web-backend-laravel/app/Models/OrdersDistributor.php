<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDistributor extends Model
{
    protected  $table = 'tw_orders_distributor';

    protected $fillable = [
       'order_id', 'distributer_id' ,'total_price', 'year', 'months', 'day', 'hour',   'created_at',
    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
              'order_id', 'distributer_id' ,'total_price', 'year', 'months', 'day', 'hour',   'created_at',
        );
    }




      
    public function distrubute_order()
    {
        return $this->belongsTo('App\Models\Distributor', 'distributer_id');
    }






}
