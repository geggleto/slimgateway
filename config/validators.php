<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2016-04-21
 * Time: 1:17 PM
 */

$container['user.fetch.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());

    return new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.create.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'name');
    $validator->rule('required', 'email');
    $validator->rule('required', 'username');
    $validator->rule('required', 'password');

    return new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.update.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'name');
    $validator->rule('required', 'email');
    $validator->rule('required', 'username');

    return new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.delete.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    

    return new \SlimGateway\ValidationMiddleware($validator);
};