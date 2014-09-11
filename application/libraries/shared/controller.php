<?php

namespace Shared
{
    use Framework\Registry as Registry;
    use Framework\Events as Events;
    use Framework\Router as Router;

    class Controller extends \Framework\Controller{

        /**
         * @readwrite
         */
        protected $_connector;

        /**
         * @readwrite
         */
        protected $_user;

        /**
         * @protected
         */
        public function _admin()
        {
            if (!$this->user->admin)
            {
                throw new Router\Exception\Controller("Not a valid admin user account");
            }
        }

        /**
         * @protected
         */
        public function _secure()
        {
            $user = $this->getUser();
            if (!$user)
            {
                $this->redirect('/login');
            }
        }

        public function __construct($options = array()){


            parent::__construct($options);

            $database = Registry::get("database");
            $database->connect();


        }

    }
}
 