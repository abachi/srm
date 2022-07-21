# SRM - Simple Resource Manager

This is my implementation for the test assignment.
Here is a [demo](https://obscure-mountain-32205.herokuapp.com/) hosted in Heroku (free plan) You might face some slowness when you visit the app for the first time
that's because Heroku puts the app to sleep after 30 minutes of inactivity.

### Prequestiques:
* [Composer](https://getcomposer.org/)
* [PHP 7.4 or +](https://www.php.net/downloads)
* [Node](https://nodejs.org/en/)
* [Postgresql](https://www.postgresql.org/) or [MySQL](https://www.mysql.com/) service

### Installation
**Clone and install the dependencies:**
```
git clone git@github.com:abachi/srm.git
```
```
cd srm
```
```
composer install && npm install
```

### Setup and run the project

1. create two databases, One for development and another for testing (i.e. `srm_development` and `srm_testing`)
2. duplicate `.env.example` two times and rename the new files `.env` and `.env.testing`
3. Replace the following evironment variables in `.env` with your environment
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=srm_development
DB_USERNAME=root
DB_PASSWORD=
```
and same thing for `.env.testing` (change database's name)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=srm_testing
DB_USERNAME=root
DB_PASSWORD=
```
4. run `php artisan key:generate && php artisan migrate --seed && npm run dev`
5. run `php artisan serve` to launch the app
6. open [http://localhost:8000](http://localhost:8000) in your browser to see the result

### Run tests
`php artisan test`
