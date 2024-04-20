<?php
// Compte.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Notifications\Notifiable;

class Compte extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable;

  
    protected $fillable = [
        'email',
        'password',
        'etat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'compte_id');
    }

      public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}