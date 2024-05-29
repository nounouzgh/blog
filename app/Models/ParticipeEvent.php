<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipeEvent extends Model
{
    use HasFactory;

    protected $table = 'ParticipeEvent';

    protected $fillable = [
        'user_id', 'evenement_payent_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function evenementPayent()
    {
        return $this->belongsTo(EvenementPayent::class, 'evenement_payent_id');
    }
}
