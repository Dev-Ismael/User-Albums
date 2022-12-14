<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];

    ############################## Relations ##############################
    public function user(){
        return  $this -> belongsTo("App\Models\User") ;
    }
    public function images(){
        return  $this -> hasMany("App\Models\Image") ;
    }


}
