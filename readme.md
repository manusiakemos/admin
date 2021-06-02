1.  composer require manusiakemos/admin

2.  composer require manusiakemos/crudgen

3.  php artisan vendor:publish --tag=crudgen

4.  composer require manusiakemos/admin

5.  php artisan vendor:publish --tag=admin

6.  php artisan vendor:publish --tag=component

7.  add role middleware to route group

8.  include admin.php in web.php

9.  add helper in composer.json

```json
 "autoload": {
    "files": [
    	"app/helper/helper.php"
    ],
    "classmap": [
    	"database/seeds",
    	"database/factories"
    ],
    	"psr-4": {
    		"App\\": "app/"
    	}
   }
```

10. composer dump-autoload

11. run composer require yajra/laravel-datatables-oracle:"~9.0"

12. copy folder public/vendor/admin/images & public/vendor/admin/fonts to public

````

```

```
````
