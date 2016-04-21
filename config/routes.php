<?php

$app->get('/users/{id}', 'user.controller:fetch')->add('user.fetch.validator');
$app->post('/users', 'user.controller:create')->add('user.create.validator');
$app->put('/users/{id}', 'user.controller:update')->add('user.update.validator');
$app->delete('/users/{id}', 'user.controller:remove')->add('user.delete.validator');