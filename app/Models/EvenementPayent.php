<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenementPayent extends Model
{
    use HasFactory;

    protected $table = 'evenement_payent';

    protected $fillable = [
        'description', 'date', 'duree', 'prix', 'specialite', 'nbr_de_place', 'expere_id',
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class, 'expere_id');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participe_event', 'evenement_payent_id', 'user_id');
    }
    

   
}
