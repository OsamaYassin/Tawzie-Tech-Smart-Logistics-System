<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vication extends Model
{

    protected  $table = 'tbl_vications';

    protected $fillable = [
        'v_name', 'v_duration' , 'start_date','end_date',
    ];



    public  function scopeSelection($query){

        return $query -> select( 'id', 'v_name', 'v_duration' , 'start_date','end_date'
        );
    }

}
