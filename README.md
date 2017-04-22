Welcome to Laravel 5.4
======================

This package could consider as a sample implementation for different features in laravel 5.4.
You can find the implemented features in below of this documents.


Local environment
-----------------

* Infyom homepage `http://labs.infyom.com/laravelgenerator/docs/5.3/introduction`

* Local set up: https://github.com/Nguonchhay/Nguonchhay.DockerLaravel

Implemented Features
--------------------

* CRUD Generator

	Infyom homepage: http://labs.infyom.com/laravelgenerator/docs/5.3/introduction

* Custom UUIDs in Laravel

	app/Traits/IdTrait.php

* Image upload with preview option

	* app/Utility/FileUtility.php

	* public/js/custom.js

* Integrate CKEditor with File Manager

	* Run some commands:
		- php artisan cache:clear
		- php artisan config:clear
		- composer dump-autoload
		- php artisan vendor:publish --tag=ckeditor-assets
		- php artisan vendor:publish --tag=lfm_config
    - php artisan vendor:publish --tag=lfm_public
    - php artisan migrate:refresh --seed
    
	* We have to login in order to perform the upload function
		- username (email): root@example.com
		- password        : root