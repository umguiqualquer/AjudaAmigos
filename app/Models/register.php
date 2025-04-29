<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class register extends Authenticatable
{
    use HasFactory;
    protected $table = 'registers';
    protected $fillable = [

    'first_name',
    'last_name',
    'password',
    'cpf',
    'date_of_birth',
    'email',
    'ddd_phone',
    'phone_number',
    'address_street',
    'address_number',
    'village',
    'city',
    'state',
    'zip_code',
    'country',

    ];

    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'password' => 'hashed',
    ];

}