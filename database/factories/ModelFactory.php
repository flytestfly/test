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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Test::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'content' => $faker->text($maxNbChars = 2000),
        'date' => '08/09/2018',
        'image' => 'photo1.jpeg',
        'description' => $faker->paragraph,
        'views' => $faker->numberBetween(0, 5000),
        'event_id' => 1,
        'user_id' => 1,
        'status' => 1,
        'is_featured' => 0
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->word
    ];
});