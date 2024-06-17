<?php

namespace Restaurants;
use Models\Employee;
use Models\User;

class RestaurantLocation{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDrive;
     
}