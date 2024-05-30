<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    use HasFactory;

    public function teacher() {
        return $this->belongsTo(User::class, 'iduser_enseignant');
    }

    public function student() {
        return $this->belongsTo(User::class, 'iduser_etudiant');
    }

    public function resource() {
        return $this->belongsTo(Resource::class, 'idressource');
    }
}
