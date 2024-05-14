<?php
// app/Models/Expert.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'specialite',
        'user_id'

];

public function users()
{
    return $this->belongsTo(User::class, 'user_id');
}
    public function demandeInscription()
    {
        return $this->hasOne(DemandeInscription::class);
    }
}
