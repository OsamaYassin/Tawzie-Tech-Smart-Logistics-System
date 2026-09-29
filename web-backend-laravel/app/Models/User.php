<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected  $table = 'users';

    protected $fillable = [
        'id', 'admin', 'name', 'email', 'avatar', 'email_verified_at', 'password', 'remember_token', 'part_acount', 'part_materail', 'part_product', 'part_inventor', 'part_hr', 'part_lab1', 'part_lab2', 'part_lab3', 'part_customer', 'part_aftersales', 'part_delivery', 'part_redayorder', 'created_at', 'updated_at'
    ];

    public  function scopeSelection($query){

        return $query -> select(
            'id', 'admin', 'name', 'email', 'avatar', 'email_verified_at', 'password', 'remember_token', 'part_acount', 'part_materail', 'part_product', 'part_inventor', 'part_hr', 'part_lab1', 'part_lab2', 'part_lab3', 'part_customer', 'part_aftersales', 'part_delivery', 'part_redayorder', 'created_at', 'updated_at'
        );
    }


}



