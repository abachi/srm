# SRM - Simple Resource Manager

This is my implementation for the test assignment.
Here is a [demo](https://obscure-mountain-32205.herokuapp.com/) hosted in Heroku where I used Postgresql as RDBMS.

PS: You might face some slowness when you visit the app for the first time
that's because Heroku puts the app to sleep after 30 minutes of inactivity.


### Design:
I've used the factory method design pattern to create resources based on the client request. the following image is showing what the resource interface looks like and what are the resources that we are currently supporting.

![image](https://user-images.githubusercontent.com/12300606/180375659-4c5e82ee-fc13-4198-9bce-4a4fdcbca633.png)

**Details about these methods:**

`rules(): array` This method should return validation rules which we are using it to validate the client request when we `store` and `update`.
The other methods are self-explained:

`store($data): Model` It creates a resource and returns its Model instance.

`update($id, $data): Model` It updates a resource and returns it.

`get($id): Model` It gets a resource.

`delete($id): Model` It removes a resource.

#### Models and Database:
We have three models with three tables:
* Link -> links
* CodeSnippet -> code_snippets
* File -> files

Each model is acting as a repository and it is interacting with the database.
`CodeSnippet` and `File` models have `type` attribute so we can reuse them as data repositories for other types, for example `JavascriptCodeSnippet` and `ImageFile` resources.
 
### Controllers and API endpoints:
One `Api\ResourceController` to serve our `vue` app client.

`GET /api/resources` to get all resources.

`POST /api/resources`to create an new resource.

`DELETE /api/resources/{resource_type}/{id}` to remove a resource.

`PUT /api/resources/{resource_type}/{id}` to update a resource

`GET /api/resources-types` to get available resource types

`GET /api/resources/{id}/download` to download a file resource


## Installation and Setup

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

### Todo:
The app has much more room to be improved like adding filtering, pagination, to be tested on different browsers and OS...
