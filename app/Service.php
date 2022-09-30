<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //protected $table="services";
    
    protected $fillable=[
           '_token',
           'name',
           'banner',
           'price'
    ];
}
