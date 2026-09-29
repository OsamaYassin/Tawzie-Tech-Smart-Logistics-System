<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{

    protected  $table = 'tbl_departments';

    protected $fillable = [
        'name',
    ];



    public  function scopeSelection($query){

        return $query -> select(  'id','name'
        );
    }

   


}
