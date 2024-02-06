## Installing

1- composer update
2- add database in mysql
3- php artisan migrate

## uses

- use the Api collection

https://api.postman.com/collections/4543278-6611ec40-717e-4cc1-9080-642bd1a0b605?access_key=PMAT-01HNTAWMNMEYQ8XGQBX0MEXWVF

## Do Test
First :- (UserTest)
    - in path tests/Feature/UserTest.php
    - to do test :
        * open cmd in path /project_root_path
        * do this commend to run all functions one time  (php artisan test)
        * if you want to run one function only do this commands:
            + php artisan test --filter user_can_register
            + php artisan test --filter user_cannot_register
            + php artisan test --filter user_can_login
            + php artisan test --filter user_cannot_login_with_invalid_credentials

Second :- (PostsTest)
    - in path tests/Feature/PostsTest.php
    - to do test :
        * open cmd in path /project_root_path
        * do this commend to run all functions one time  (php artisan test)
        * if you want to run one function only do this commands:
            + php artisan test --filter user_can_create_post
            + php artisan test --filter user_can_update_post
            + php artisan test --filter user_can_delete_post
