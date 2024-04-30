<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable implements AuthenticatableContract
{

    use HasFactory, Notifiable;
    protected $guard = 'admin';

    protected $fillable = [
        'name',
        'prenom',
        
    ];



    // Define the compte relationship
    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

}
