<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CorreosModel>
 */
class CorreosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_mensaje' => $this->faker->uuid(),
            'asunto' =>  $this->faker->sentence(3),
            'enviado' =>  $this->faker->email(),
            'mensaje' =>  $this->faker->text(),
            'created_at' =>  date('Y-m-d H:i:s')
        ];
    }
}
