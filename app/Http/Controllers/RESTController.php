<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReflectionMethod;
use ReflectionClass;

class RESTController extends Controller {

    private $model;

    public function setModel($model) {
        $this->model = $model;
    }

    public function index() {
        $reflectionMethod = new ReflectionMethod('App\\'.$this->model, 'all');
        return $reflectionMethod->invoke(null);
    }
    
    public function show($id){
        $reflectionMethod = new ReflectionMethod('App\\'.$this->model, 'find');
        return $reflectionMethod->invoke(null, $id);        
    }
    
    public function destroy($id){
        $reflectionMethod = new ReflectionMethod('App\\'.$this->model, 'find');
        $model =  $reflectionMethod->invoke(null, $id);
        $model->delete();
    }
    
    public function store(Request $request){
        $reflectionClass = new ReflectionClass('App\\'.$this->model);
        $class = $reflectionClass->newInstance(json_decode($request->getContent(),true));              
        $class->save();
    }
    
    public function update(Request $request, $id){        
        $reflectionMethod = new ReflectionMethod('App\\'.$this->model, 'find');
        $return = $reflectionMethod->invoke(null, $id);
        
        $fillMethod = new ReflectionMethod('App\\'.$this->model, 'fill');
        $class = $fillMethod->invoke($return, json_decode($request->getContent(),true));
        
        $class->save();
    }

}
