<?php

namespace Helpers;

use Faker\Factory;
use Models\User;
use Restaurants\RestaurantChain;
use CustomProviders\RestaurantNameProvider;
use CustomProviders\AwardProvider;
use Models\Employee;

class RandomGenerator {
    public static function user(): User {
        $faker = Factory::create();

        return new User(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email(),
            $faker->password(),
            $faker->phoneNumber(),
            $faker->address(),
            $faker->dateTimeThisCentury(),
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor'])
        );
    }

    public static function users(int $min, int $max): array {
        $faker = Factory::create();
        $users = [];
        $numOfUsers = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfUsers; $i++) {
            $users[] = self::user();
        }

        return $users;
    }

    public static function restaurantChain(): RestaurantChain{
        $faker = Factory::create();
        $faker->addProvider(new RestaurantNameProvider());

        return new RestaurantChain(
            $faker->restaurantName(),
            $faker->randomNumber(),
            $faker->text(40),
            $faker->url(),
            $faker->phoneNumber(),
            'Food industry',
            $faker->name(),
            $faker->randomElement(["Yes", "No"]),
            $faker->country(),
            $faker->name(),
            $faker->randomNumber(),
            $faker->randomNumber(),
            [],//restaurantLoaction
            $faker->randomNumber(),
            $faker->country()
        );
    }

    public static function restaurantChains(int $min, int $max): array{
        $faker = Factory::create();
        $restaurantChains = [];
        $numOfRestaurantChains = $faker->numberBetween($min, $max);
        for ($i = 0; $i < $numOfRestaurantChains; $i ++){
            $restaurantChains[] = self::restaurantChain();
        }
        return $restaurantChains;
    }

    public static function employee(): Employee{
        $faker = Faker::create();
        $faker->addProvider(new AwardProvider());
        $awards = [];
        $numberOfAwards = $faker->numberBetween(0, 5);
        for($i = 0; $i < $numberOfAwards; $i++){
            $awards[] = $faker->award(); 
        }
        return new Employee(
            $faker->randomNumber(),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email(),
            $faker->password(),
            $faker->phone(),
            $faker->address(),
            $faker->dateTimeThisCentury(),
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->jobTitle(),
            $faker->randomFloat(),
            $faker->dateTimeThisCentury(),
            $awards
        );
    }
}
