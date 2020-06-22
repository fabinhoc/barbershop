<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Client;
use App\Appointment;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'serviceName' => $faker->name,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'client_id' => function () {
            return factory(Client::class)->create()->id;
        },
        'dateExecution' => $faker->date(),
        'initialHour' => $faker->time(),
        'endHour' => $faker->time(),
        'isConfirmed' => $faker->boolean(false)
    ];
});
