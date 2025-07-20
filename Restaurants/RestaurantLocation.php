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
        string $state, string $zipCode, array $employees, bool $isOpen, bool $hasDriveThru = false)
        {
            $this->name =  $name;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zipCode = $zipCode;
            $this->employees = $employees;
            $this->isOpen = $isOpen;
            $this->hasDriveThru = $hasDriveThru;
        }
    
    public function getEmployees(): array {
        return $this->employees;
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
        is Open: %s\n
        Drive Thru: %s",
        $this->name, 
        $this->address, 
        $this->city, 
        $this->state, 
        $this->zipCode, 
        $employeesName, 
        $this->isOpen ? 'Yes' : 'No',
        $this->hasDriveThru ? 'Yes' : 'No'
        );
    }

    public function toHTML() :string{
        $employeesName = array_map(function(Employee $employee){
            return $employee->getFullName();
        }, $this->employees);
        $employeesName = implode(', ', $employeesName);
        $uniqueId = 'collapse-' . uniqid();
        return sprintf("
            <div class=\"accordion-item\" style=\"border: 1px solid #dee2e6; border-radius: 5px;\">
                <h2 class=\"accordion-header\">
                    <button class=\"accordion-button\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#%s\" aria-expanded=\"false\" aria-controls=\"%s\">
                        Restaurant name: <b>%s</b>
                    </button>
                </h2>
                <div id=\"%s\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordionExample\">
                    <div class=\"accordion-body\">
                        <p>Address: %s %s, %s, %s</p>
                        <p>Employee: %s</p>
                        <p>Open?: %s</p>
                        <p>Drive?: %s</p>
                    </div>
                </div>
            </div>",
        $uniqueId, $uniqueId,
            $this->name,
            $uniqueId,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeesName,
            $this->isOpen ? 'Yes' : 'No',
            $this->hasDriveThru ? 'Yes' : 'No'
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