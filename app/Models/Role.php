<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function admins()
    {
        return $this->belongsToMany(User::class);
    }
    
    public static function findID($name)
    {
        $role = static::where('name', $name)->first();
        return $role ? $role->id : null;
    }

   
}
