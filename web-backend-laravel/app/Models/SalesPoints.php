<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPoints extends Model
{
    protected  $table = 'tw_sales_point';

    protected $fillable = [
        'id', 'point_name', 'phone', 'type', 'area', 'distribut_id','visit' ,'latitude', 'longitude',
        'active', 'created_at','updated_at' ,'note'
    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select('id', 'point_name', 'phone', 'type', 'area','distribut_id','visit' ,'latitude', 'longitude',
        'active', 'created_at','updated_at','note'
        );
    }


/*
    public function productsRelation()
    {
        return $this->belongsToMany('App\Models\Products', 'tbl_product_components' ,'id_materail','id_product');
    }
*/

        public function distrubute_relation()
        {
            return $this->belongsTo('App\Models\Distributor', 'distribut_id');
        }



    /*public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers', 'id');
    }*/






}
