<?php
use \Shared\Model;

class Book extends Model{


    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     */
    protected $_title;

    /**
     * @column
     * @readwrite
     * @type integer
     * @length 11
     */
    protected $_author;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     */
    protected $_isbn;

    /**
     * @column
     * @readwrite
     * @type integer
     * @length 4
     */
    protected $_year;

    /**
     * @column
     * @readwrite
     * @type integer
     * @length 2
     */
    protected $_rating;

    /**
     * @readwrite
     * @type text
     */
    protected $_authorFirstName;

    /**
     * @readwrite
     * @type text
     */
    protected $_authorLastName;

    /**
     *
     * Here are the automated joins
     *
     * @var array
     */
    public $joins = array(
        'author' => array(
            'ON' => 'book.author = author.id',
            'fields'=> array(
                'author.first_name AS authorFirstName',
                'author.last_name AS authorLastName',
            )
        ),
    );


    /**
     * method used to get the records in array format
     */
    public static function getAllForApi(array $where = array()){
        $items = self::allWithJoins(
            $where,
            array(
                'book.title','book.created',
                'author.first_name AS authorFirstName',
                'author.last_name AS authorLastName',
            )
        );

        if (count($items) != 0){
            $return = array();

            foreach ($items as $item) {



                $return[] = array(
                    'title' => $item->title,
                    'author' => self::formatName($item->authorFirstName,$item->authorLastName),
                );
            }

            return $return;

        }
        return null;
    }

    public static function formatName($first = null, $last = null){
       $name =array();

       if (!is_null($first) && strlen($first) != 0 ){
           $name[] = $first;
       }

        if (!is_null($first) && strlen($last) != 0 ){
           $name[] = $last;
       }

        if (count($name) > 0){
            return implode(' ', $name);
        }else{
            return '';
        }
    }

} 