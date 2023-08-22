<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{

    private array $iphoneNames = [
        'Apple iPhone 12 Pro Max 256GB HDD - 6GB RAM - Midnight Black',
        'Apple iPhone 11 Slim Edition 128GB HDD - 4GB RAM - Space Gray',
        'Apple iPhone XS Ultra Performance 512GB HDD - 8GB RAM - Silver',
        'Apple iPhone 13 Mini 64GB HDD - 4GB RAM - Coral Pink',
        'Apple iPhone SE Ultimate 256GB HDD - 6GB RAM - Sky Blue',
        'Apple iPhone 12 Pro Compact 128GB HDD - 6GB RAM - Graphite',
        'Apple iPhone XR Super Bright 128GB HDD - 4GB RAM - Red',
        'Apple iPhone 14 Pro Max 512GB HDD - 8GB RAM - Mystic Gold',
        'Apple iPhone 13 Pro Eco-Friendly 256GB HDD - 6GB RAM - Forest Green',
        'Apple iPhone 12 UltraSlim 64GB HDD - 4GB RAM - Glacier White',
        'Apple iPhone 11X Plus 256GB HDD - 6GB RAM - Space Black',
        'Apple iPhone 12 Mini Lite 128GB HDD - 4GB RAM - Ice Blue',
        'Apple iPhone 13 Max Performance 512GB HDD - 8GB RAM - Cosmic Gray',
        'Apple iPhone 12 Pro Mini 256GB HDD - 6GB RAM - Rose Gold',
        'Apple iPhone 11R Ultra Bright 128GB HDD - 4GB RAM - Sunset Orange',
        'Apple iPhone 14 Pro Solar-Powered 512GB HDD - 8GB RAM - Solar Flare',
        'Apple iPhone 13 SlimFit 256GB HDD - 6GB RAM - Ocean Blue',
        'Apple iPhone XS AirLight 128GB HDD - 4GB RAM - Aurora Green',
        'Apple iPhone 12 Pro Stealth Edition 256GB HDD - 6GB RAM - Onyx Black',
        'Apple iPhone 11 Nano 64GB HDD - 4GB RAM - Silver Chrome',
        'Apple iPhone 14 UltraThin 512GB HDD - 8GB RAM - Pearl White',
        'Apple iPhone 13 Pro Eclipse 256GB HDD - 6GB RAM - Midnight Blue',
        'Apple iPhone 12 Mini Lite 128GB HDD - 4GB RAM - Cloud Gray',
        'Apple iPhone XR Solar 128GB HDD - 4GB RAM - Solar Red',
        'Apple iPhone 11 EvoMax 256GB HDD - 6GB RAM - Cosmic Silver',
        'Apple iPhone 14 Pro Luxe 512GB HDD - 8GB RAM - Royal Gold',
        'Apple iPhone 13 AirSlim 256GB HDD - 6GB RAM - Sky Blue',
        'Apple iPhone XS Neo 128GB HDD - 4GB RAM - Neo Green',
        'Apple iPhone 12 Pro UltraLite 256GB HDD - 6GB RAM - Crystal Clear',
        'Apple iPhone 11 FlexiFit 64GB HDD - 4GB RAM - Flexi Blue',
        'Apple iPhone 14 Hyper 512GB HDD - 8GB RAM - Hyper Red',
        'Apple iPhone 13 PowerSlim 256GB HDD - 6GB RAM - Power Black',
        'Apple iPhone XR Aurora 128GB HDD - 4GB RAM - Aurora Pink',
        'Apple iPhone 12 Pro Aero 256GB HDD - 6GB RAM - Aero Silver',
        'Apple iPhone 11 Stealth 128GB HDD - 4GB RAM - Stealth Gray',
        'Apple iPhone 14 Spark 512GB HDD - 8GB RAM - Spark Orange',
        'Apple iPhone 13 Pro Slim 256GB HDD - 6GB RAM - Slim Silver',
        'Apple iPhone XS CrystalClear 128GB HDD - 4GB RAM - Crystal White',
        'Apple iPhone 12 Mini Neon 256GB HDD - 6GB RAM - Neon Green',
        'Apple iPhone 11X SuperNova 64GB HDD - 4GB RAM - SuperNova Blue',
        'Apple iPhone 14 Pro UltraFit 512GB HDD - 8GB RAM - UltraFit Black',
        'Apple iPhone 13 Air 256GB HDD - 6GB RAM - Air Silver',
        'Apple iPhone XR Starlight 128GB HDD - 4GB RAM - Starlight Gold',
        'Apple iPhone 12 EvoMax 256GB HDD - 6GB RAM - EvoMax Gray',
        'Apple iPhone 11 SolarFlare 64GB HDD - 4GB RAM - SolarFlare Red',
        'Apple iPhone 14 Pro Flexi 512GB HDD - 8GB RAM - Flexi Green',
        'Apple iPhone 13 Mini Luxe 256GB HDD - 6GB RAM - Luxe Silver',
        'Apple iPhone XS UltraSlim 128GB HDD - 4GB RAM - UltraSlim Black',
        'Apple iPhone 12 Pro Aero 256GB HDD - 6GB RAM - Aero Rose',
        'Apple iPhone 11 Aurora 64GB HDD - 4GB RAM - Aurora Purple',
    ];


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specs = [
            'ram' => $this->faker->randomElement(['2GB', '4GB', '8GB', '16GB']),
            'rom' => $this->faker->randomElement(['32GB', '64GB', '128GB', '256GB']),
            'screen_size' => $this->faker->randomElement(['5.5 inches', '6.2 inches', '6.7 inches']),
            'processor' => $this->faker->randomElement(['Snapdragon 865', 'Apple A14 Bionic', 'Exynos 2100']),
            'camera' => $this->faker->randomElement(['12MP', '48MP', '64MP', '108MP']),
            'battery_capacity' => $this->faker->randomElement(['3000 mAh', '4000 mAh', '5000 mAh', '6000 mAh']),
            'operating_system' => $this->faker->randomElement(['iOS 15', 'One UI 3.0']),
            'connectivity' => $this->faker->randomElement(['4G LTE', '5G', 'Wi-Fi 6', 'Bluetooth 5.2']),
            'colors' => $this->faker->randomElements(['Black', 'White', 'Blue', 'Red'], 2),

        ];


        return [
            'name' => $this->faker->unique()->randomElement($this->iphoneNames),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'color' => $this->faker->safeColorName(),
            'specs' => json_encode($specs),
            'brand' => $this->faker->company(),
            'category_id' => Category::all()->random()->id,
            'stock' => $this->faker->numberBetween(0, 100),
            'discount_percentage' => $this->faker->numberBetween(0, 30),
        ];
    }
}
