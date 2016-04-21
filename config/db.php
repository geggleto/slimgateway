<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 12:33 PM
 */

use SlimGateway\EntityController;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

$container['adapter'] = function ($c) {
    return new Adapter($c['settings']['db']);
};

$container['users.gateway'] = function ($c) {
    return new TableGateway('users', $c['adapter']);
};

$container['user.controller'] = function ($c) {
    return new EntityController($c['users.gateway']);
};