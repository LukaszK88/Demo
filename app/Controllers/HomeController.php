<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:57
 */
namespace Demo\Controllers;

use Slim\Views\Twig as View;

class HomeController extends Controller{

  
    public function index($request,$response){

        return $this->view->render($response,'home.twig');
    }
}