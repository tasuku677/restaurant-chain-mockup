<?php

namespace Helpers;

use Faker\Factory;
use CustomProviders\RestaurantNameProvider;
use CustomProviders\AwardProvider;

use Models\Employee;

use Restaurants\RestaurantChain;
use Restaurants\RestaurantLocation;

class RandomGenerator {

    public static function employee(): Employee{
        $faker = Factory::create();
        $faker->addProvider(new AwardProvider($faker));
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
            $faker->phoneNumber(),
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
        $employees = [];
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
        $faker = Factory::create('en_US');
        $faker->addProvider(new RestaurantNameProvider($faker));

        $restaurant_name = $faker->restaurantName();
        $foundingYear = $faker->dateTimeBetween('-30 years', 'now')->format('Y');
        $restaurantLocations = self::restaurantLocations(1, 5);
        $totalEmployees = 0;
        foreach ($restaurantLocations as $restaurant) {
            $totalEmployees += count($restaurant->getEmployees());
        }

        return new RestaurantChain(
            $restaurant_name,
            $foundingYear,
            $faker->text(40),
            $faker->url(),
            $faker->phoneNumber(),
            'Food industry',
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $totalEmployees,
            $faker->randomNumber(),
            $restaurantLocations,
            explode(' ', $restaurant_name)[count(explode(' ', $restaurant_name)) - 1],
            count($restaurantLocations),
            $faker->boolean(),
            $foundingYear - $faker->numberBetween(0, 50),
            $faker->company()  
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
