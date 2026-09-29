<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complayment extends Model
{

    protected  $table = 'tbl_complayments';

    protected $fillable = [
        'o_id', 'product_name', 'customer_name' , 'customer_phone','complayment','solution', 'status'
    ];



    public  function scopeSelection($query){

        return $query -> select(  'id','o_id', 'product_name', 'customer_name' , 'customer_phone','complayment','solution', 'status'
        );
    }

}
