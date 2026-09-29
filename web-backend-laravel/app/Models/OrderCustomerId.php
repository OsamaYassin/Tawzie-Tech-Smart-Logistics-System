<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCustomerId  extends Model
{
    protected  $table = 'tbl_id';

    protected $fillable = [
        'id', 'order_id ', 'created_at','updated_at'
    ];



    public  function scopeSelection($query){

        return $query -> select('id', 'order_id ', 'created_at','updated_at'
        );
    }






}
