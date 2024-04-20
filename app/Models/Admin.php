<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'nom',
        'prenom',
        'compte_id',
        'role_id', 
    ];

    // Define the compte relationship
    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

    // Define the role relationship
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
