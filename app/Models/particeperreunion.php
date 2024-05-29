<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class particeperreunion extends Model
{
    use HasFactory;
    protected $table = 'particeperreunion';
    
    protected $fillable = [
        'user_id', 'reunion_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }
}
