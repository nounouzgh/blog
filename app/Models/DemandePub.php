<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandePub extends Model
{
    use HasFactory;

    protected $table = 'demande_pubs';

    protected $fillable = [
        'nom',
        'tel',
        'email',
        'description',
        'specialite',
        'ads_id',
        'accepted'
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pieceJoints()
    {
        return $this->hasMany(PieceJoint::class, 'id_demande_pub');
    }

    public function justificationCompitences()
    {
        return $this->hasMany(JustificationCompitence::class, 'iddemande');
    }

    public function ad()
    {
        return $this->belongsTo(Ads::class, 'ads_id');
    }
}
