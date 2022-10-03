<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProgress extends Model
{
    //use HasFactory;

    protected $fillable=[
        '_token',
        'user_id',
        'account_id',
        'total_sales',
        'total_profit',
        'total_loss',
        'today_card_charge',
        'date',
 ];
}
