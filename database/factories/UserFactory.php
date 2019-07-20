<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:45 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:42 AM
 * Copyright (c) 2019 . All rights reserved
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use FixNairobi\Photo;
use FixNairobi\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
$factory->define(\FixNairobi\Feedback::class,function (Faker $faker){

    return[
        'email'=>$faker->unique()->safeEmail,
        'message'=>$faker->text
    ];
});
$factory->define(\FixNairobi\Problem::class,function (Faker $faker){
   return[
       'location' => '('.$faker->latitude($min = 	-1.28333,$max = 	-2.28333).','.$faker->longitude($min = -180, $max = 180).')',
       'landmark' => $faker->city,
       'moredetails' => $faker->paragraph,
       'Title' => $faker->word,
       'issueid'=>4
   ] ;
});
$factory->define(\FixNairobi\TypeIssues::class,function(Faker $faker){
    return[
      'desc'=>$faker->word
    ];
});

$factory->define(Photo::class,function (Faker $faker){
   return[
       'path'=>$faker->imageUrl($width = 640, $height = 480)
   ];
});
$factory->define(\FixNairobi\IssueStatus::class,function(Faker $faker){
   return[
      'status'=>'Not Fixed',
   ] ;
});

