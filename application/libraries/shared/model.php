<?php

namespace Shared
{
    class Model extends \Framework\Model
    {
        /**
         * @column
         * @readwrite
         * @primary
         * @type autonumber
         */
        protected $_id;

        /**
         * @column
         * @readwrite
         * @type boolean
         * @index
         */
        protected $_live = 1;

        /**
         * @column
         * @readwrite
         * @type datetime
         * @index
         */
        protected $_deleted = null;

        /**
         * @column
         * @readwrite
         * @type datetime
         */
        protected $_created;

        /**
         * @column
         * @readwrite
         * @type datetime
         */
        protected $_modified;

    }
}
