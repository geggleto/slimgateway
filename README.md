# Slim Gateway
    Take the boilerplate out of your day. Need a simple API to insert data into SQL Tables? This is for you.

# Setup
 - Change the contents of `config/db.php`
 - To define your resources:
    - Create Validators in `config/validators.php`
    - Create a Gateway and Controller entry in `config/db.php`
    - Define your routes in `config/routes.php`
    
    
# Validation
There is a cavet for validation. Validation will only take place on the initial data set, anything you add in via middleware is not available for validation.