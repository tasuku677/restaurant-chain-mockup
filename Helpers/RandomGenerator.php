<?php

namespace Helpers;

use Faker\Factory;
use CustomProviders\RestaurantNameProvider;
use CustomProviders\AwardProvider;

use Models\User;
use Models\Employee;

use Restaurants\RestaurantChain;
use Restaurants\RestaurantLocation;

use Companies\Company;

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

    public static function employee(): Employee{
        $faker = Factory::create();
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
    public static  function employees(int $min, int $max): array{
        $faker = Factory::create();
        $employeees = [];
        $numOfEmployees = $faker->numberBetween($min, $max);

        for ($i = 0; $i < $numOfEmployees; $i++){
            $employees[] = self::employee();
        }
        return $employees;
    }

    public static function restaurantLocation(): RestaurantLocation{
        $faker = Factory::create();
        return new RestaurantLocation(
            $faker->word(),
            $faker->address(),
            $faker->city(),
            $faker->state(),
            $faker->postcode(),
            self::employees(1, 5),
            $faker->randomElement(["Yes", "No"]),
            $faker->randomElement(["Yes", "No"])
        );
    }
    
    public static function restaurantLocations(int $min, int $max): array{
        $faker = Factory::create();
        $restaurantLocations = [];
        $numberOfLLocations = $faker->numberBetween($min, $max);
        for($i = 0; $i < $numberOfLLocations; $i ++){
            $restaurantLocations[] = self::restaurantLocation();
        }
        return $restaurantLocations;
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
            self::restaurantLocations(1, 5),//restaurantLoaction
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
}
