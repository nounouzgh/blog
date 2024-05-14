<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeInscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'lien',
        'specialite',
        'expert_id', // Assuming this is the foreign key for the expert relationship
    ];

    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}