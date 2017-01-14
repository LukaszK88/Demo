<?php
/**
 * Created by PhpStorm.
 * User: Lukasz
 * Date: 10/01/2017
 * Time: 14:25
 */

$app->post('/add','UserController:postAdd')->setName('add.user');

$app->get('/get','UserController:getUsers')->setName('get.users');
$app->post('/get','UserController:postUsers');

$app->get('/get/{schoolId}','UserController:getUsersBySchool')->setName('get.usersBySchool');