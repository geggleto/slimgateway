<?php

$app->get('/users/{id}', 'UserController:fetch')->add('user.fetch.validator');
$app->post('/users', 'UserController:create')->add('user.create.validator');
$app->put('/users/{id}', 'UserController:update')->add('user.update.validator');
$app->delete('/users/{id}', 'UserController:remove')->add('user.delete.validator');