<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\PN\Users\User::class, function ($faker) {
    return [
        'identifier' => str_random(10),
        'username' => $faker->username,
        'name' => $faker->name,
        'email' => $faker->email,
        'avatar' => $faker->image,
        'password' => str_random(10),
        'remember_token' => str_random(10),
        'social' => 1
    ];
});
