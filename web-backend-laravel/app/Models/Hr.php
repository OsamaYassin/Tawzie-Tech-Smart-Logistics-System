<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hr extends Model
{



    protected  $table = 'hr_table';
    public $timestamps = true;

    protected $fillable = [
        'e_id', 'e_name','e_department','e_salary','bounces','minuses', 'bill_number'
    ];
}
