<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Use the appropriate table name if it's not 'roles'
    protected $table = 'roles'; 

    // Define the mass assignable fields
    protected $fillable = ['name', 'description'];

    /**
     * A role can have many users.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}