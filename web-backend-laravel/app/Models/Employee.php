<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected  $table = 'tbl_employees';

    protected $fillable = [
        'e_name', 'e_email' , 'e_department','e_cv','path',
    ];



    public  function scopeSelection($query){

        return $query -> select(  'id','e_name','e_email', 'e_department','e_cv', 'path'
        );
    }

    public function DepartRelation()
    {
        return $this->belongsTo('App\Models\Department', 'Department','e_department');
    }

}
