<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    private array $iphoneTypes = [
        'iPhone 1',
        'iPhone 3G',
        'iPhone 3GS',
        'iPhone 4',
        'iPhone 4S',
        'iPhone 5',
        'iPhone 5C',
        'iPhone 5S',
        'iPhone 6',
        'iPhone 6 Plus',
        'iPhone 6S',
        'iPhone 6S Plus',
        'iPhone SE (1st generation)',
        'iPhone 7',
        'iPhone 7 Plus',
        'iPhone 8',
        'iPhone 8 Plus',
        'iPhone X',
        'iPhone XR',
        'iPhone XS',
        'iPhone XS Max',
        'iPhone 11',
        'iPhone 11 Pro',
        'iPhone 11 Pro Max',
        'iPhone SE (2nd generation)',
        'iPhone 12',
        'iPhone 12 Mini',
        'iPhone 12 Pro',
        'iPhone 12 Pro Max',
        'iPhone 13',
        'iPhone 13 Mini',
        'iPhone 13 Pro',
        'iPhone 13 Pro Max',
        'iPhone SE (3rd generation)',
        'iPhone 14',
        'iPhone 14 Mini',
        'iPhone 14 Pro',
        'iPhone 14 Pro Max',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement($this->iphoneTypes),
        ];
    }
}

