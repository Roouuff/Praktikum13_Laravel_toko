<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Model Profile
class Profile extends Model
{
    protected $fillable = ['user_id', 'phone', 'address', 'birthdate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
