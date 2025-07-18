<?php
    namespace CustomProviders;

    use Faker\Provider\Base;

    class RestaurantNameProvider extends Base {
        protected static $adjectives = ['Delicious', 'Crunchy', 'Chewy', 'Unique', 'Fresh', 'Awesome', 'Spicy', 'Yummy', 'Tasty'];
        protected static $nouns = ['Bistro', 'Cafe', 'Grill', 'Diner', 'Bar', 'Restaurant', 'Eatery', 'Pub'];
        protected static $cuisines = ['Italian', 'Mexican', 'Indian', 'Japanese', 'French', 'American', 'Chinese'];

        public function restaurantName():string{
            $adjective = self::$adjectives[array_rand(self::$adjectives)];
            $noun = self::$nouns[array_rand(self::$nouns)];
            $cuisine = self::$cuisines[array_rand(self::$cuisines)];

            return sprintf("%s %s %s", $adjective, $noun, $cuisine);
        }
    }