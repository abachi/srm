<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class FileFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = 'pdf';
        $path = $type . '/' . $this->faker->sha1() . '.' . $type;
        Storage::disk('local')->put($path, $this->faker->text());

        return [
            'title' => $this->faker->text(),
            'path' => $path,
            'type' => $type,
        ];
    }
}
