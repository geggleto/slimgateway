<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 12:33 PM
 */

use SlimGateway\EntityController;

$container['settings']['db'] = [
    'driver' => 'Pdo_Mysql',
    'database' => 'test',
    'username' => 'root',
    'password' => '',
    'hostname' => '127.0.0.1'
];

$container['adapter'] = function ($c) {
    return new \Zend\Db\Adapter\Adapter($c['settings']['db']);
};

$container['users'] = function ($c) {
    return new \Zend\Db\TableGateway\TableGateway('user', $c['adapter']);
};

$container['UserController'] = function ($c) {
    return new EntityController($c['users']);
};