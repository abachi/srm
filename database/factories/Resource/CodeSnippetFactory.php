<?php

namespace Database\Factories\Resource;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class CodeSnippetFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'code_snippet' => $this->faker->randomHtml(),
            'type' => 'html'
        ];
    }
}
