<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductComponent extends Model
{
    protected  $table = 'tbl_product_components';

    protected $fillable = [
        'id', 'id_product', 'id_materail' ,'num_unit' , 'created_at','updated_at'
    ];


    public  function scopeSelection($query){

        return $query -> select('id', 'id_product', 'id_materail' ,'num_unit' , 'created_at','updated_at'
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
