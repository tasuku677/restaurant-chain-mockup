<?php

namespace Restaurants;
use Interfaces\FileConvertible;
use Models\Employee;

class RestaurantLocation implements FileConvertible{
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees;
    private bool $isOpen;
    private bool $hasDriveThru;
    
    public function __construct(
        string $name, string $address, string $city,
        string $state, string $zipCpde, array $employees, bool $isOpen, bool $hasDriveThru)
        {
            $this->name =  $name;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zipCpde = $zipCpde;
            $this->employees = $employees;
            $this->isOpen = $isOpen;
            $this->hasDriveThru = $hasDriveThru;
        }
        
    public function toString() : string{
        return sprintf("Restaurant name: %s\n Address: %s\n City: %s\n State: %s\n Zip Code: %s\n Employees: %s\n is Open: %s\n has Drive: %s",
        $this->name, $this->address, $this->city, $this->state, $this->zipCode, implode(', ', $this->employees), var_export($this->isOpen), var_export($this->hasDriveThru));
    }

    public function toHTML() :string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->lastName . $employee->firstName;
        }, $this->employees);
        return sprintf("
            <div class='restaurant-location'>
                <div class='location'>SAMPLE</div>
                <h2>%s</h2>
                <p>%s %s, %s, %s</p>
                <p>%s</p>
                <p>Open? :%s</p>
                <p>Drive? :%s</p>
            </div>",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeesName,
            var_export($this->isOpen), 
            var_export($this->hasDriveThru)
        );
    }

    public function toMarkdown() :string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->lastName . $employee->firstName;
        }, $this->employees);
        $employeesName = implode(', ', $employeesName);
        $isOpen = var_export($this->isOpen);
        $hasDriveThru = var_export($this->hasDriveThru);

        return "## Restaurant Name: {$this->name}
                 - Location: {$this->address} {$this->city} {$this->state} {$this->zipCode}
                 - Employees: {$employeesName}
                 - Be Open?: {$isOpen}
                 - Has DriveThru: {$hasDriveThru}";
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employees' => implode(', ', $this->employees),
            'isOpen' => var_export($this->isOpen),
            'hasDrive' => var_export($this->hasDriveThru),
        ];
    }
}