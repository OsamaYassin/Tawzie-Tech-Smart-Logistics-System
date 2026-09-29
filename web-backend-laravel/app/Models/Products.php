<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products  extends Model
{
    protected  $table = 'tw_product';

    protected $fillable = [
        'id', 'product_name', 'size', 'descrip', 'price', 'available_amount',
        'created_at','updated_at'
    ];

   // protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id', 'product_name', 'size', 'descrip', 'price', 'available_amount',
            'created_at','updated_at'
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
