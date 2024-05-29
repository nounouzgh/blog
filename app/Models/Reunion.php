<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date',
        'duree',
        'specialite',
        'iduser_etd',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'iduser_etd');
    }

     public function participants()
    {
        return $this->hasMany(Particeperreunion::class);
    }
}
