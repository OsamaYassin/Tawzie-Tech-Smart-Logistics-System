<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected  $table = 'tbl_expenses';

    protected $fillable = [
        'id', 'name', 'value' , 'comment','created_at','updated_at'
    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id', 'name', 'value' , 'comment','created_at','updated_at'
        );
    }



  /*  public function productsRelation()
    {
        return $this->belongsToMany('App\Models\Products', 'tbl_product_components' ,'id_materail','id_product');
    }*/



    /*public function teacher()
    {
        return $this->belongsTo('App\Models\Teachers', 'id');
    }*/






}
