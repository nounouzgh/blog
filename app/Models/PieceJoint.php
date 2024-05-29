<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJoint extends Model
{
    use HasFactory;
    
    protected $fillable = ['lien', 'type', 'id_demande_pub'];

    public function demandePub()
    {
        return $this->belongsTo(DemandePub::class, 'id_demande_pub');
    }
}
