<?php
// app/Models/Pet.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'name', 'type', 'breed', 'age', 'gender', 'size',
        'description', 'location', 'image', 'vaccinated',
        'trained', 'status'
    ];

    protected $casts = [
        'vaccinated' => 'boolean',
        'trained' => 'boolean',
    ];

    // Relationships
    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    // Check if pet is available
    public function isAvailable()
    {
        return $this->status === 'available';
    }
}