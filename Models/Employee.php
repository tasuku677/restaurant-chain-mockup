<?php
    namespace Models;
    
    use Models\User;
    use DateTime;

    class Employee extends User{
        private string $jobTitle;
        private float $salary;
        private DateTime $startDate;
        private array $awards;

        public function __construct(string $jobTitle, float $salary, DateTime $startDate, array $awards){
            $this->jobTitle = $jobTitle;
            $this->salary = $salary;
            $this->startDate = $startDate;
            $this->awards = $awards;
        }
    }