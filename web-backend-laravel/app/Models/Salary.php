<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{

    protected  $table = 'tbl_employees_salary';

    protected $fillable = [
        'id', 'e_name','e_department','salary',
    ];



    public  function scopeSelection($query){

        return $query -> select(  'id','e_name','e_department' ,'salary',
        );
    }

}
