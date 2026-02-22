<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=> $this->faker->sentence(3),
            "isbn"=> $this->faker->unique()->isbn13(),
            "description"=> $this->faker->paragraph(),
            "author_id"=> Author::inRandomOrder()->first()->id ?? Author::factory(),
            "genre"=> $this->faker->randomElement(['fiction','motivational','Non-fiction','Fantasy','Romance']),
            "published_at"=> $this->faker->date(),
            "total_copies"=> $this->faker->numberBetween(1,30),
            "avaiable_copies"=> $this->faker->numberBetween(1,30),
            "price"=>$this->faker->randomFloat(1,20,99),
            "cover_image"=>$this->faker->imageUrl('200','300','books',true),
            // "status"=>$this->faker->randomElement(["active","inactive"]),
        ];
    }
}
