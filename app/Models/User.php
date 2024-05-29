<?php

// User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prenom',
        'compte_id',
        'role_id', // Make sure 'role_id' is included here
        'image',
        
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function expert()
    {
        return $this->hasOne(Expert::class);
    }

  

    public function visiteur()
    {
        return $this->hasOne(Visiteur::class);
    }

    // Define the compte relationship
    public function compte()
    {
      //  return $this->belongsTo(Compte::class, 'compte_id');
        return $this->belongsTo(Compte::class);
    }
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
    public function comments()
{
    return $this->hasMany(Comment::class);
}

public function signal()
{
    return $this->hasMany(Signal::class);
}

public function ads()
{
    return $this->hasMany(Ads::class, 'user_id');
}

public function competences()
{
    return $this->hasMany(Competence::class, 'iduser');
}

public function participations()
{
    return $this->hasMany(Particeperreunion::class);
}

public function participationsEvenementPayent()
{
    return $this->belongsToMany(EvenementPayent::class, 'ParticipeEvent', 'user_id', 'evenement_payent_id');
}

public function EvenementPayent()
{
    return $this->belongsToMany(EvenementPayent::class, 'participe_event', 'user_id', 'evenement_payent_id');
}


}
