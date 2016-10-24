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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt('123123'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Submission::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'abstract' => $faker->text($maxNbChars = 200),
        'keywords' => $faker->text($maxNbChars = 200),
    ];
});

$factory->define(App\SubmissionAuthor::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
    ];
});