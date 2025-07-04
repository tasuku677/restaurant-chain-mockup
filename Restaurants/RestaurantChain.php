<?php

namespace Restaurants;
use Companies\Company;

class RestaurantChain extends Company {
    private int $chainId;
    private array $restaurantLocation;
    private string $cuisineType;

    private int $numberOfLocations;
    private bool $hasDriveThru;
    private int $yearFounded;
    private string $parentCompany;

    public function __construct(string $name, int $foundingYear, string $description, string $website,
        string $phone, string $industry, string $ceo, bool $isPublicityTraded,
        string $country, string $founder, int $totalEmployees, int $chainId, array $restaurantLocation, string $cuisineType, int $numberOfLocations, bool $hasDriveThru, int $yearFounded, string $parentCompany) {
        
        parent::__construct($name, $foundingYear, $description, $website,
        $phone, $industry, $ceo, $isPublicityTraded,
        $country, $founder, $totalEmployees);

        $this->chainId = $chainId;
        $this->restaurantLocation = $restaurantLocation;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->hasDriveThru = $hasDriveThru;
        $this->yearFounded = $yearFounded;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string {
        $locationsString = array_map(function($location) {
            return $location->toString();
        }, $this->restaurantLocation);
        $locationsString = implode("\n", $locationsString);

        return sprintf(
            "%sChain ID: %d\nNumber of Locations: %d\nDriveThru: %s\nYearFounded: %d\nParent Company: %s\n",
            parent::toString(),
            $this->chainId,
            $locationsString,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->yearFounded,
            $this->parentCompany,
        );
    }

    public function toHTML(): string {
        $locationsHTML = array_map(function($location) {
            return $location->toString();
        }, $this->restaurantLocation);
        $locationsHTML = implode("<br>", $locationsHTML);

        return sprintf("
            %s
            <div class='restaurant-chain'>
                <p><strong>Chain ID:</strong> %d</p>
                <p><strong>Locations:</strong><br>%s</p>
                <p><strong>Cuisine Type:</strong> %s</p>
                <p><strong>Number of Locations:</strong> %d</p>
                <p><strong>Has Drive-Thru:</strong> %s</p>
                <p><strong>Year Founded:</strong> %d</p>
                <p><strong>Parent Company:</strong> %s</p>
            </div>",
            parent::toHTML(),
            $this->chainId,
            $locationsHTML,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? 'Yes' : 'No',
            $this->yearFounded,
            $this->parentCompany,
        );
    }

    public function toMarkdown(): string {
        $locationsMarkdown = array_map(function($location) {
            return $location->toString();
        }, $this->restaurantLocation);
        $locationsMarkdown = implode("\n", $locationsMarkdown);

        return sprintf(
            "%s\n- **Chain ID:** %d\n- **Locations:**%s\n- **cuisineType:**%s\n- **Number of Locations:** %d\n- **hasDriveThru:**%s\n- **yearFounded:**%d\n- **Parent Company:** %s\n-\n",
            parent::toMarkdown(),
            $this->chainId,
            $locationsMarkdown,
            $this->cuisineType,
            $this->numberOfLocations,
            $this->hasDriveThru ? "Yes":"No",
            $this->yearFounded,
            $this->parentCompany
        );
    }

    public function toArray(): array {
        $locationsArray = array_map(function($location) {
            return $location->toArray();
        }, $this->restaurantLocation);

        return array_merge(parent::toArray(), [
            'chainId' => $this->chainId,
            'restaurantLocation' => $locationsArray,
            'cuisineType' => $this->cuisineType,
            'numberOfLocations' => $this->numberOfLocations,
            'hasDriveThru' => $this->hasDriveThru ? true : false,
            'yearFounded' => $this->yearFounded,
            'parentCompany' => $this->parentCompany
        ]);
    }
}
?>
