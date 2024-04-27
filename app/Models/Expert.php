<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model // Update class name
{
    use HasFactory;
    protected $fillable = ['specialite'];
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
