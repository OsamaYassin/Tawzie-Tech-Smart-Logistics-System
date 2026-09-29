<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDistributor extends Model
{
    protected  $table = 'tw_sales_distributor';

    protected $fillable = [
        'sales_id', 'point_id' ,'distributer_id', 'total_price', 'chash', 'banckk', 'sheck', 'agel','note', 'year', 'months', 'day', 'hour','created_at','updated_at','note',
    ];
    //protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'sales_id', 'point_id' ,'distributer_id', 'total_price', 'chash', 'banckk', 'sheck', 'agel', 'year', 'months', 'day', 'hour','created_at','updated_at', 'note',
        );
    }





     public function distrubute_sales()
    {
        return $this->belongsTo('App\Models\SalesPoints', 'point_id', 'id');
    }

    public function distrubuter_points()
    {
        return $this->belongsTo('App\Models\Distributor', 'distributer_id', 'id');
    }







}
