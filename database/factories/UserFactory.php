<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
function getCategory()
{
    return App\Models\Category::pluck('id')->toArray();
}

function getServiceCategory()
{
    return App\Models\ServiceCategory::pluck('id')->toArray();
}

function getServiceProvider()
{
    return App\Models\ServiceProvider::pluck('id')->toArray();
}

function getServiceProviderService()
{
    return App\Models\ServiceProviderService::pluck('id')->toArray();
}

function getServiceQuestion()
{
    return App\Models\ServiceQuestion::pluck('id')->toArray();
}

$factory->define(App\Models\User::class, function (Faker $faker) {

    return [
        'user_name' => $faker->name,
        'full_name' => $faker->name,
        'password' => '$2y$10$mXwEFI/nQub9PmCejn59zuozRujElm4bu5D01y.wXpciRnKjHRWNm', // admin
        'email' => Str::random(10) . $faker->email,
        'role' => $faker->randomElement($array = range(0, 1)),
    ];
});

$factory->define(App\Models\Configration::class, function (Faker $faker) {
    return [
        "website_name" => "ديلفري المدينه",
        'email' => $faker->safeEmail,
        'description' => "موقع متميز الخدمات والاداء العالي",

        "about_us" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo",

        'registration_conditions' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                                        
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                                        
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                                        
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo",
        "how_work"=> "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo",

        "privacy" => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?

                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo?
                        
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam neque excepturi nihil facere magnam hic laborum vero, soluta eum consectetur harum obcaecati aperiam unde eligendi impedit pariatur vitae esse nemo",

        'phone' => $faker->e164PhoneNumber,
        'address' => $faker->address,
        'facebook' => "https://www.facebook.com/",
        'twitter' => "https://twitter.com/",
        'instagram' => "https://www.instagram.com/", //
        'youtube' => "https://www.youtube.com",
    ];
});

$factory->define(App\Models\Complaint::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'phone' => $faker->name,
        'message' => $faker->sentence,
    ];
});


