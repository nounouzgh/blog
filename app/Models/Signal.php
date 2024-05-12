<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Signal extends Model
{
    protected $fillable = ['compte_id', 'user_id', 'signal_date', 'cause'];

    public function compte()
    {
        return $this->belongsTo(Compte::class, 'compte_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

  
}
