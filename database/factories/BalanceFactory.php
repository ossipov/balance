<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Balance;
use Faker\Generator as Faker;

$factory->define(Balance::class, function (Faker $faker) {
    return [
        'label' => $faker->sentence,
        'date' => $faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now', $timezone = null),
        'amount' => $faker->numberBetween($min = -100000, $max = 100000),
    ];
});
