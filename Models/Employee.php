<?php

namespace Models;

use DateTime;
use Interfaces\FileConvertible;
class Employee extends User implements FileConvertible {
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;

    public function __construct(
        int $id, string $firstName, string $lastName, string $email,
        string $password, string $phoneNumber, string $address,
        DateTime $birthDate, DateTime $membershipExpirationDate, string $role,
        string $jobTitle, float $salary, DateTime $startDate, array $awards
    ) {
        parent::__construct(
            $id, $firstName, $lastName, $email, $password, $phoneNumber, $address,
            $birthDate, $membershipExpirationDate, $role
        );
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function toString(): string {
        $userString = parent::toString();
        return $userString . sprintf(
            "Job Title: %s\nSalary: %.2f\nStart Date: %s\nAwards: %s\n",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toHTML(): string{
        $userHTML = parent::toHTML();
        return $userHTML . sprintf("
            <p>Job Title: %s</p>
            <p>Salary: %.2f</p>
            <p>Start Date: %s</p>
            <p>Awards: %s</p>
        ",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toMarkdown(): string {
        $userMarkdown = parent::toMarkdown();
        return $userMarkdown . "\n" . sprintf(
            "### 
            - Job Title: %s\n
            - Salary: %.2f\n
            - Start Date: %s\n
            - Awards: %s\n",
            $this->jobTitle,
            $this->salary,
            $this->startDate->format('Y-m-d'),
            implode(', ', $this->awards)
        );
    }

    public function toArray(): array {
        $userArray = parent::toArray();
        return array_merge($userArray, [
            'jobTitle' => $this->jobTitle,
            'salary' => $this->salary,
            'startDate' => $this->startDate->format('Y-m-d'),
            'awards' => $this->awards
        ]);
    }
}
?>
