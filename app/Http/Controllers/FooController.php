<?php namespace App\Http\Controllers;


class FooController extends RESTController{
    
    public function __construct() {
        parent::setModel('Foo');
    }
}
