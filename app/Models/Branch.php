<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    // If the table name is different from the pluralized version of the model name:
    // protected $table = 'branches_table'; 

    // If the table does not have timestamps (created_at and updated_at):
    // public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'working_hours',
        'image',
    ];

    // Optional: Add mutators or accessors if you need to modify data when it is retrieved or saved.
    // Example: If you want to always return an absolute path for the image:
    // public function getImageAttribute($value)
    // {
    //     return asset($value);  // Adds the full URL path to the image
    // }
}
