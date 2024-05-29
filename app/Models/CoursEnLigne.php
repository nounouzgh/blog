<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursEnLigne extends Model
{
    protected $table = 'cours_en_ligne';
    protected $fillable = [
        'event', 'description', 'date', 'duree', 'prix', 'specialite', 'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}