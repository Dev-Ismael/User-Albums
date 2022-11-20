<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'album_id',
        'user_id',
    ];


    ############################## Relations ##############################
    public function album(){
        return  $this -> belongsTo("App\Models\Album") ;
    }

}
