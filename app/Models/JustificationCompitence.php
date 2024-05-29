<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificationCompitence extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'iddemande'];

    public function demandePub()
    {
        return $this->belongsTo(DemandePub::class, 'iddemande');
    }
}
