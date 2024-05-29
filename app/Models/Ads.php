<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'specialite', 'date', 'id_owner', 'user_id', 'dien'];

    public function owner()
    {
        return $this->belongsTo(Owners::class, 'id_owner');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

        public function demandePub()
    {
        return $this->hasOne(DemandePub::class, 'ads_id');
    }

}
