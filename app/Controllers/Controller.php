<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 15:12
 */
namespace Demo\Controllers;

use Demo\Models\User;

class Controller{

    protected $container;
                

    
    public function __construct($container){

        $this->container = $container;
        
    }

    public function __get($property){

       if($this->container->{$property}){
           return $this->container->{$property};
       }
    }

}