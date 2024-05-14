<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'specialite', // Add any other fields here that you want to be mass assignable
        'date_naissance',
        'niveau',
        // Add other fields here as necessary
    ];
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
