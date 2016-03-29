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
        'identifier'     => str_random(10),
        'username'       => $faker->username,
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => Hash::make('password'),
        'remember_token' => str_random(10),
        'social'         => 0,
    ];
});

$factory->define(\PN\Assets\Asset::class, function ($faker) {
    return [
        'identifier' => str_random(10),
        'name'       => $faker->name,
        'description' => $faker->text
    ];
});

$factory->define(\PN\Resources\Album::class, function ($faker) {
    return [

    ];
});

$factory->define(\PN\Resources\Mod::class, function ($faker) {
    return [
        'source' => $faker->url,
    ];
});

$factory->define(\PN\Assets\Tag::class, function ($faker) {
    return [
        'type' => $faker->randomElement(['blueprint', 'park', 'mod']),
        'tag' => $faker->name,
        'slug' => $faker->slug,
        'parkitect_type' => $faker->name,
        'primary' => $faker->boolean
    ];
});

$factory->define(\PN\Social\Comment::class, function ($faker) {
    return [
        'body' => $faker->text
    ];
});

$factory->define(\PN\Social\Like::class, function ($faker) {
    return [
        'weight' => 1
    ];
});

$factory->define(\PN\Tracking\Download::class, function ($faker) {
    return [
        'ip' => $faker->ipv4
    ];
});

$factory->define(\PN\Tracking\View::class, function ($faker) {
    return [
        'ip' => $faker->ipv4
    ];
});

$factory->define(\PN\Resources\Image::class, function($faker) {
    return [
        'source' => str_random(32).'.jpg'
    ];
});

$factory->define(\PN\Resources\Blueprint::class, function($faker) {
    $image = factory(\PN\Resources\Image::class)->create();

    return [
        'image_id' => $image->id,
        'source' => str_random(32).'.png'
    ];
});

$factory->define(\PN\Resources\Park::class, function($faker) {
    $image = factory(\PN\Resources\Image::class)->create();

    return [
        'image_id' => $image->id,
        'source' => str_random(32).'.txt'
    ];
});


