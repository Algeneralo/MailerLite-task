<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;

    public function definition()
    {
        return [
            'name'       => $this->faker->name(),
            'email'      => $this->faker->unique()->freeEmail(),
            'state'      => $this->faker->randomElement(Subscriber::$default_states),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
