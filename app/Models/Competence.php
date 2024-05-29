<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $table = 'competences';

    protected $fillable = [
        'description',
        'date',
        'duree',
        'centerFormation_unive',
        'iduser',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }

}
