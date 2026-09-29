<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersDistributorDetail extends Model
{
    protected  $table = 'tw_orders_distributor_detail';

    protected $fillable = [
        'id','order_id', 'sold_amount', 'order_amount', 'order_date', 'reminder_amount', 'distributer_id','product_id' ,
        'total_price','created_at','updated_at'    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id','order_id', 'sold_amount', 'order_amount', 'order_date', 'reminder_amount', 'distributer_id','product_id' ,
            'total_price','created_at','updated_at'        );
    }



    public function product_order_detail()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }







}
