<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presolution extends Model
{

    protected  $table = 'tbl_pre_solutions';

    protected $fillable = [
         'complayment','product_name','solution',
    ];



    public  function scopeSelection($query){

        return $query -> select('id','complayment','product_name','solution'
        );
    }

}
