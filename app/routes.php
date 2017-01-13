<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:25
 */

$app->get('/','HomeController:index')->setName('home');

$app->get('/add','UserController:getAdd')->setName('add.user');
$app->post('/add','UserController:postAdd');

$app->get('/get[/{schoolId}]','UserController:getUsers')->setName('get.users');
$app->post('/get[/{schoolId}]','UserController:postUsers');