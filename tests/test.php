<?php
namespace Tests{


    class Test extends \Framework\Test{
        public function __construct(){
            echo 'Tests class loaded'.PHP_EOL;
            new Books\TestBooks();
            new Books\Api\Api();
        }
    }
}