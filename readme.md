 1. composer require manusiakemos/crudgen
 2. php artisan vendor:publish --tag=crudgen
 3. composer require manusiakemos/admin
 4. php artisan  vendor:publish --tag=admin
 5. php artisan  vendor:publish --tag=component
 6. add role middleware to route group
 7. include admin.php in web.php
 8. add helper in composer.json

 `"autoload": {
    "files": [
        "app/helpers.php"
    ],
    "classmap": [
        "database/seeds",
        "database/factories"
    ],
    "psr-4": {
        "App\\": "app/"
    }
},`

 9. composer dump-autoload
 10. run composer require yajra/laravel-datatables-oracle:"~9.0"

