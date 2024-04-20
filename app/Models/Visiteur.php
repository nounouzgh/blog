<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Visiteur extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name']; // Add other fillable fields as needed

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
