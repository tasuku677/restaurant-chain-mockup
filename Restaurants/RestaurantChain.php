<?php
    namespace Restaurants;
    use Restaurants\RestaurantLocation;
    use Companies\Company;

    class RestaurantChain extends Company{
        private int $chainId;
        private array $restaurantLocation;
        private int $numberOfLocations;
        private string $parentCompany;

        public function __construct(int $chainId, array $restaurantLocation, int $numberOfLocations, string $parentCompany){
            $this->chainId = $chainId;
            $this->restaurantLocation = $restaurantLocation;
            $this->numberOfLocations = $numberOfLocations;
            $this->parentCompany = $parentCompany;
        }
        
    }