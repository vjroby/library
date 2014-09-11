<?php

use \Shared\Model;

class Author extends Model{
    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     */
    protected $_name;

} 