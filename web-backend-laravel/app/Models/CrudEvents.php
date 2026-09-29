<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CrudEvents extends Model
{
    use HasFactory;
    protected  $table = 'event';
    protected $fillable = [
        'event_name', 
        'event_start', 
        'event_end'
    ];  
    
    public  function scopeSelection($query){

        return $query -> select( 'event_name', 
        'event_start', 
        'event_end'
        );
    }
}


