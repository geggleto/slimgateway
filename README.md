# Slim Gateway
Take the boilerplate out of your day. Need a simple API to insert data into SQL Tables? This is for you.

# Setup
 - Change the contents of `config/db.env.php` to connect to your database
 - To define your resources:
    - Create Validators in `config/validators.php`
    - Create a Gateway and Controller entry in `config/db.php`
    - Define your routes in `config/routes.php`
    - Run the users migration `composer migrate:users`
    
    
# Validation
There is a cavet for validation. Validation will only take place on the initial data set, anything you add in via middleware is not available for validation.

# Migrations
 - Add more migrations in the `/migrations/` folder
 - Add a composer command to make running them easy!
 - Make sure to add the composer command to the unit tests when you do then too!

# Example

### In `config/db.php`
```php
$container['users.gateway'] = function ($c) {
    return new TableGateway('user', $c['adapter']);
};

$container['user.controller'] = function ($c) {
    return new EntityController($c['users.gateway']);
};
```

### In `config/validators.php`
```php
$container['user.fetch.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'id');

    new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.create.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'name');
    $validator->rule('required', 'email');
    $validator->rule('required', 'username');
    $validator->rule('required', 'password');

    new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.update.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'name');
    $validator->rule('required', 'email');
    $validator->rule('required', 'username');

    new \SlimGateway\ValidationMiddleware($validator);
};

$container['user.delete.validator'] = function ($c) {
    /** @var $request \Slim\Http\Request */
    $request = $c['request'];
    $validator = new \Valitron\Validator($request->getParsedBody());
    $validator->rule('required', 'id');

    new \SlimGateway\ValidationMiddleware($validator);
};
```

### In `config/routes.php`
```php
$app->get('/users/{id}', 'user.controller:fetch')->add('user.fetch.validator');
$app->post('/users', 'user.controller:create')->add('user.create.validator');
$app->put('/users/{id}', 'user.controller:update')->add('user.update.validator');
$app->delete('/users/{id}', 'user.controller:remove')->add('user.delete.validator');
```


# Unit Testing
`composer test`

