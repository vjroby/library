<?php

namespace Tests\Books
{

    use \Tests\Test as Test;
    use \Framework as Framework;

    class TestBooks extends Test{

        public function __construct(){
            echo 'Tests Test Books loaded.'.PHP_EOL;

            self::runAll();

        }

        public static function runAll(){

            $reflect =  new \ReflectionClass(get_class());
            $methods = $reflect->getMethods(\ReflectionMethod::IS_STATIC);

            foreach ($methods as $method) {
                $name = $method->name;
                if(!in_array($name, array('run','add','start','runAll'))){
                    self::$name();

                }
            }
        }

        /**
         * Test if the model exists
         */
        public static function book(){
            parent::add(
                function()
                {
                    $book = new \Book();
                    return ($book instanceof \Book);
                },
                "Book (Model) instantiates in uninitialized state",
                "Book"
            );
        }

        /**
         * Test if the controller exists
         */
        public static function books(){
            parent::add(
                function()
                {
                    $books = new \Books();
                    return ($books instanceof \Books);
                },
                "Books (Controller) instantiates in uninitialized state",
                "Book"
            );
        }

    }
}
