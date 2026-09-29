<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DebtCollection extends Model
{
    protected  $table = 'tw_debt_collection';

    protected $fillable = [
       'id', 'sales_id', 'point_id' ,'distributer_id',  'chash', 'banckk', 'sheck', 'agel', 'year', 'months', 'day', 'hour','created_at','updated_at'
    ];

    public  function scopeSelection($query){

        return $query -> select(
        'id',  'sales_id', 'point_id' ,'distributer_id',  'chash', 'banckk', 'sheck', 'agel', 'year', 'months', 'day', 'hour','created_at','updated_at'
        );
    }


    public function point_debt()
    {
        return $this->belongsTo('App\Models\SalesPoints', 'point_id');
    }




}
