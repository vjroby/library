<?php

class Start extends \Framework\Controller{

      public function tests(){
          $this->setCustomLayoutView('test');
          \Framework\Test::start();
         $this->actionView->set('data',\Framework\Test::run()) ;

      }
} 