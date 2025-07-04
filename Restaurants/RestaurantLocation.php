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
        string $state, string $zipCode, array $employees, bool $isOpen)
        {
            $this->name =  $name;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zipCode = $zipCode;
            $this->employees = $employees;
            $this->isOpen = $isOpen;
        }
        
    public function toString() : string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->getFullName();
        }, $this->employees);
        $employeesName = implode(', ', $employeesName);
        return sprintf("Restaurant name: %s\n 
        Address: %s\n 
        City: %s\n 
        State: %s\n 
        Zip Code: %s\n 
        Employees: %s\n 
        is Open: %s\n",
        $this->name, 
        $this->address, 
        $this->city, 
        $this->state, 
        $this->zipCode, 
        $employeesName, 
        $this->isOpen ? 'Yes' : 'No');
    }

    public function toHTML() :string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->getFullName();
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
            $this->isOpen ? 'Yes' : 'No'
        );
    }

    public function toMarkdown() :string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->getFullName();
        }, $this->employees);
        $employeesName = implode(', ', $employeesName);
        $isOpen = $this->isOpen ? 'Yes' : 'No';

        return "## Restaurant Name: {$this->name}
                 - Location: {$this->address} {$this->city} {$this->state} {$this->zipCode}
                 - Employees: {$employeesName}
                 - Be Open?: {$isOpen}";
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zipCode' => $this->zipCode,
            'employees' => implode(', ', $this->employees),
            'isOpen' => $this->isOpen ? 'Yes' : 'No',
        ];
    }
}