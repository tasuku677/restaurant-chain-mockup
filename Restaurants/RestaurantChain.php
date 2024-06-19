<?php

namespace Restaurants;
use Companies\Company;

class RestaurantChain extends Company {
    private int $chainId;
    private array $restaurantLocation;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name, int $foundingYear, string $description, string $website,
        string $phone, string $industry, string $ceo, bool $isPublicityTraded,
        string $country, string $founder, int $totalEmployees, int $chainId,
        array $restaurantLocation, int $numberOfLocations, string $parentCompany
    ) {
        parent::__construct(
            $name, $foundingYear, $description, $website, $phone, $industry,
            $ceo, $isPublicityTraded, $country, $founder, $totalEmployees
        );
        $this->chainId = $chainId;
        $this->restaurantLocation = $restaurantLocation;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public function toString(): string {
        $locationsString = array_map(function($location) {
            return $location->toString();
        }, $this->restaurantLocation);
        $locationsString = implode("\n", $locationsString);

        return sprintf(
            "%sChain ID: %d\nNumber of Locations: %d\nParent Company: %s\nLocations:\n%s\n",
            parent::toString(),
            $this->chainId,
            $this->numberOfLocations,
            $this->parentCompany,
            $locationsString
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
                <p><strong>Number of Locations:</strong> %d</p>
                <p><strong>Parent Company:</strong> %s</p>
                <p><strong>Locations:</strong><br>%s</p>
            </div>",
            parent::toHTML(),
            $this->chainId,
            $this->numberOfLocations,
            $this->parentCompany,
            $locationsHTML
        );
    }

    public function toMarkdown(): string {
        $locationsMarkdown = array_map(function($location) {
            return $location->toString();
        }, $this->restaurantLocation);
        $locationsMarkdown = implode("\n", $locationsMarkdown);

        return sprintf(
            "%s\n- **Chain ID:** %d\n- **Number of Locations:** %d\n- **Parent Company:** %s\n- **Locations:**\n%s\n",
            parent::toMarkdown(),
            $this->chainId,
            $this->numberOfLocations,
            $this->parentCompany,
            $locationsMarkdown
        );
    }

    public function toArray(): array {
        $locationsArray = array_map(function($location) {
            return $location->toArray();
        }, $this->restaurantLocation);

        return array_merge(parent::toArray(), [
            'chainId' => $this->chainId,
            'numberOfLocations' => $this->numberOfLocations,
            'parentCompany' => $this->parentCompany,
            'restaurantLocation' => $locationsArray
        ]);
    }
}
