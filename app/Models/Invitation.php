<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'reunion_id', 'invitation_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }
}
