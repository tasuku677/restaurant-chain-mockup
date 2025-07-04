<?php

namespace CustomProviders;
use Faker\Provider\Base;

class AwardProvider extends Base
{
    protected static $awards = [
        'Best Employee of the Year',
        'Excellence in Customer Service',
        'Top Salesperson',
        'Innovation Award',
        'Team Player Award',
        'Leadership Excellence',
        'Outstanding Achievement',
        'Employee of the Month',
        'Service Excellence',
        'Sales Achievement Award'
    ];

    public function award()
    {
        return self::$awards[array_rand(self::$awards)];
    }
}
