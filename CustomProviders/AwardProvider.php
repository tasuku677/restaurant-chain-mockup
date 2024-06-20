<?php

namespace CustomProviders;

class AwardProvider
{
    protected $awards = [
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
        return $this->awards[array_rand($this->awards)];
    }
}
