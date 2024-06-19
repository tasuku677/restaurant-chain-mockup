<?php
    namespace CustomProviders;

    class RestaurantNameProvider{
        protected $adjectives = ['Delicious', 'Crunchy', 'Chewy', 'Unique', 'Fresh', 'Awesome', 'Spicy', 'Yummy', 'Tasty'];
        protected $nouns = ['Bistro', 'Cafe', 'Grill', 'Diner', 'Bar', 'Restaurant', 'Eatery', 'Pub'];
        protected $cuisines = ['Italian', 'Mexican', 'Indian', 'Japanese', 'French', 'American', 'Chinese'];

        public function restaurantName(){
            $adjective = $this->adjectives[array_rand($this->adjectives)];
            $noun = $this->nouns[array_rand($this->nouns)];
            $cuisine = $this->cuisines[array_rand($this->cuisines)];

            return sprintf("%s %s %s", $adjective, $noun, $cuisine);
        }
    }