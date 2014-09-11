<?php
use \Shared\Controller;
/**
 * @property mixed actionView
 */

class Books extends Controller{

    public  function getBooks(){
        $this->isApiNavigation = true;

        $arrayWhere = array();

        $arrayGet = array();

        $arrayGet['isbn'] = \Framework\RequestMethods::get('isbn', true, null);
        $arrayGet['title'] = \Framework\RequestMethods::get('title', true, null);
        $arrayGet['author.last_name'] = \Framework\RequestMethods::get('author', true, null);
        //$arrayGet['author.first_name'] = \Framework\RequestMethods::get('author', true, null);

        foreach ($arrayGet as $k => $v) {
            if (!is_null($v)){
                $arrayWhere[$k] = array('%'.$v.'%', 'LIKE');
            }
        }

        $rating = \Framework\RequestMethods::get('rating', true, null);
        if (!is_null($rating) && is_numeric($rating)){
            $arrayWhere['rating'] = array($rating, '>=');
        }
        $year = \Framework\RequestMethods::get('year', true, null);
        if (!is_null($rating) && is_numeric($rating)){
            $arrayWhere['year'] = $year;
        }

        $start_date = strtotime(\Framework\RequestMethods::get('start_date', true, false));
        $end_date = strtotime(\Framework\RequestMethods::get('end_date', true, false));

        if ($start_date){
            $arrayWhere['book.created'] = array('FROM_UNIXTIME('.$start_date.')', '>=', true);
        }

        if ($end_date){
            $arrayWhere['book.created'] = array('FROM_UNIXTIME('.$end_date.')', '<=', true);
        }

        $books = Book::getAllForApi($arrayWhere);
        if (!is_null($books)){
            $this->actionView->set('books', $books);
        }else{
            \Framework\Registry::get('httpRequest')->setResponseCode(\Framework\HttpRequest::HTTP_RESPONSE_NO_CONTENT);
        }

    }
}