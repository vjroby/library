<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 9/11/14
 * Time: 9:50 PM
 */

namespace Tests\Books\Api{
    use \Framework;
    use Tests\Books\TestBooks;

    class Api extends TestBooks{
        public function __construct(){
            echo 'Tests Test Books Api loaded.'.PHP_EOL;

            self::runAllApi();
        }

        public static function runAllApi(){

            $reflect =  new \ReflectionClass(get_class());
            $methods = $reflect->getMethods(\ReflectionMethod::IS_STATIC);
            $parentMethods = $reflect->getParentClass()->getMethods(\ReflectionMethod::IS_STATIC);
            $parentMethodsArray = [];
            foreach ($parentMethods as $parentMethod) {
                $parentMethodsArray[] = $parentMethod->getName();
            }
            $parentMethodsArray[] = __FUNCTION__;


            foreach ($methods as $method) {
                $name = $method->name;
                if(!in_array($name, $parentMethodsArray)){
                    self::$name();

                }
            }
        }

        public static function TestIsArray(){
            Framework\Test::add(
                function()
                {
                    $books = \Book::getAllForApi();

                    return (is_array($books));
                },
                "Book class initialize",
                "Returns an array"
            );
        }
    }
}


