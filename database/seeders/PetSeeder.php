<?php
// database/seeders/PetSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        $pets = [
            [
                'name' => 'Max',
                'type' => 'dog',
                'breed' => 'Golden Retriever',
                'age' => 2,
                'gender' => 'male',
                'size' => 'large',
                'description' => 'Max is a friendly and energetic Golden Retriever. He loves to play fetch and go for walks. Great with kids and other pets. Looking for an active family!',
                'location' => 'Karachi',
                'vaccinated' => true,
                'trained' => true,
                'status' => 'available',
            ],
            [
                'name' => 'Luna',
                'type' => 'cat',
                'breed' => 'Persian',
                'age' => 1,
                'gender' => 'female',
                'size' => 'small',
                'description' => 'Luna is a beautiful Persian cat with a calm temperament. She loves to cuddle and purr. Perfect for apartment living!',
                'location' => 'Lahore',
                'vaccinated' => true,
                'trained' => false,
                'status' => 'available',
            ],
            [
                'name' => 'Charlie',
                'type' => 'dog',
                'breed' => 'Labrador',
                'age' => 3,
                'gender' => 'male',
                'size' => 'large',
                'description' => 'Charlie is a loyal Labrador who loves swimming and outdoor activities. He is well-trained and obedient.',
                'location' => 'Islamabad',
                'vaccinated' => true,
                'trained' => true,
                'status' => 'available',
            ],
            [
                'name' => 'Bella',
                'type' => 'cat',
                'breed' => 'Siamese',
                'age' => 2,
                'gender' => 'female',
                'size' => 'medium',
                'description' => 'Bella is a playful Siamese cat. She is very social and loves attention. Great companion for singles or couples.',
                'location' => 'Karachi',
                'vaccinated' => true,
                'trained' => false,
                'status' => 'available',
            ],
            [
                'name' => 'Rocky',
                'type' => 'dog',
                'breed' => 'German Shepherd',
                'age' => 4,
                'gender' => 'male',
                'size' => 'large',
                'description' => 'Rocky is a protective and intelligent German Shepherd. Perfect for families needing a guard dog. Very loyal!',
                'location' => 'Rawalpindi',
                'vaccinated' => true,
                'trained' => true,
                'status' => 'available',
            ],
        ];

        foreach ($pets as $pet) {
            Pet::create($pet);
        }
    }
}