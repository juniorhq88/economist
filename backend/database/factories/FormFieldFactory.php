<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FormField>
 */
class FormFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'form_id' => \App\Models\Form::factory(),
            'label' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['text', 'email', 'tel', 'textarea', 'select', 'radio', 'checkbox']),
            'required' => $this->faker->boolean,
            'order' => $this->faker->numberBetween(1, 10),
            'file_path' => $this->faker->optional()->sentence,
        ];
    }
}
