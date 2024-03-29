<?php
namespace Framework
{
    use Framework\Base as Base;
//    use Framework\Database as Database;
    use Framework\Database\Exception as Exception;

    class Database extends Base{

        /**
         * used for joins
         */
        const LEFT_JOIN = 0;

        /**
         * used for joins
         */
        const RIGHT_JOIN = 1;

        /**
         * used for joins
         */
        const OUTER_JOIN = 2;

        /**
         * @readwrite
         */
        protected $_type;

        /**
         * @readwrite
         */
        protected $_options;

        protected function _getExceptionForImplementation($method)
        {
            return new Exception\Implementation("{$method} method not implemented");
        }

        public function initialize()
        {
            Events::fire("framework.database.initialize.before", array($this->type, $this->options));

            if (!$this->type)
            {
                $configuration = Registry::get("configuration");

                if ($configuration)
                {
                    $configuration = $configuration->initialize();
                    $parsed = $configuration->parse("configuration/database");

                    if (!empty($parsed->database->default) && !empty($parsed->database->default->type))
                    {
                        $this->type = $parsed->database->default->type;
                        unset($parsed->database->default->type);
                        $this->options = (array) $parsed->database->default;
                    }
                }
            }

            if (!$this->type)
            {
                throw new Exception\Argument("Invalid type");
            }

            Events::fire("framework.database.initialize.after", array($this->type, $this->options));

            switch ($this->type)
            {
                case "mysql":
                {
                    return new Database\Connector\Mysql($this->options);
                    break;
                }
                default:
                    {
                    throw new Exception\Argument("Invalid type");
                    break;
                    }
            }
        }
    }
}
 