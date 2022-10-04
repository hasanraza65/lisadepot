<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAccount extends Model
{
    use HasFactory;

    protected $fillable=[
        '_token',
        'user_id',
        'account_name'
 ];
}
