<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['specialite', 'grade'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reunions()
    {
        return $this->hasMany(Reunion::class, 'iduser_etd');
    }

    public function coursEnLignes()
    {
        return $this->hasMany(CoursEnLigne::class);
    }
}
