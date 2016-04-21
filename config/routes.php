<?php

$app->get('/users/{id}', 'UserController:fetch');
$app->post('/users', 'UserController:create');
$app->put('/users/{id}', 'UserController:update');
$app->delete('/users/{id}', 'UserController:remove');