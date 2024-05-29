<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreRequi extends Model
{

    protected $table = 'pre_requi';
    protected $fillable = [
        'description', 'event_id'
    ];

    public function coursEnLigne()
    {
        return $this->belongsTo(CoursEnLigne::class, 'event_id');
    }
}
