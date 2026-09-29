<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerOrder  extends Model
{
    protected  $table = 'tbl_customer_order';

    protected $fillable = [
       'id', 'order_id', 'customer_id',  'product_id', 'product_quantity' ,'total_price', 'address_delivery', 'price_delivery', 'status',  'sending_delivery', 'delivery_done','order_type','created_at','updated_at'
    ];

   // protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id',  'order_id', 'customer_id',  'product_id', 'product_quantity' ,'total_price', 'address_delivery', 'price_delivery', 'status', 'sending_delivery',  'delivery_done','order_type','created_at','updated_at'
        );
    }


   /* public function materialsRelation(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Materials', 'tbl_product_components' ,'id_product','id_materail');
    }*/

   /* public function students()
    {
        return $this->hasMany('App\Models\Students', 'id_alhalga');
    }



    public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers', 'id');
    }*/






}
