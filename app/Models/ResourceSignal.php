<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceSignal extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'user_id',
        'resource_id',
        'cause',
        'date',
      
   
    ];

     /**
     * Get the user that signaled the resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the resource that was signaled.
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
