<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'description',
        'lien',
        'date',
        'nbr_signal',
        'user_id', // assuming user_id is the foreign key
    ];

    protected $casts = [
        'date' => 'datetime', // cast date attribute to a datetime instance
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
