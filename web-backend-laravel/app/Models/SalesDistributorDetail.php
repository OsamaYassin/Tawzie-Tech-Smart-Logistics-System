<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDistributorDetail extends Model
{
    protected  $table = 'tw_distributer_sales_detail';

    protected $fillable = [
        'id','sales_id', 'point_id', 'product_id', 'distributer_id', 'distribution_date', 'distributed_amount','total_price' ,
        'created_at','updated_at'   ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id','sales_id', 'point_id', 'product_id', 'distributer_id', 'distribution_date', 'distributed_amount','total_price' ,
        'created_at','updated_at'      );
    }



    public function product_order_detail()
    {
        return $this->belongsTo('App\Models\Products', 'product_id');
    }







}
