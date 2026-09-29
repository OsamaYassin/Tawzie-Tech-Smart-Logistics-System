<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distributor  extends Model
{
    protected  $table = 'tw_distributer';

    protected $fillable = [
        'id', 'name', 'phone', 'username', 'password', 'vihicle_no', 'admin_id', 'area_name',
        'active', 'created_at','updated_at'
    ];

   // protected  $hidden =['pivot'];


    public  function scopeSelection($query){

        return $query -> select(
            'id', 'name', 'phone', 'username', 'password', 'vihicle_no', 'admin_id', 'area_name',
            'active', 'created_at','updated_at'
        );
    }







}
