# Temper CSV Chart

Read CSV File and spopulate to HighChart JS

## Getting Started

### Prerequisites

1. Install [Docker](https://www.docker.com/) 
2. create folder **"temper"**

>**Reason to use docker is its easy to setup for small to huge scale project. And less issues with pc comparability(Windows/Linux/Max). Can run project on any environment and can setup multiple PHP versions for multiple projects with their packages and bundles.**  

### Installing
Get Clone from the [repo](https://github.com/Abdulla-nilam/temper_csv_chart.git)
>This will create these folders backend, ngnix, .env, docker-compose.yml

open console(if windows use [cmder](https://cmder.net/)) and navigate to project folder and run :

```
docker-compose build
```

And once it compiled

```
docker-compose up
```

Open another console and 

```
docker exec -it temper_backend_1 bash
```

and then 

```
composer install
composer update
```


once done

```
php artisan key:generate
```

## Getting Started

To run the project Hit

```
http://localhost:8099/
```

## Built With

* [Laravel 6](https://laravel.com/) - The php framework used
* [Docker](https://www.docker.com/) - To setup environment

## Authors

* **Abdulla Nilam** - **[Stack Overflow](https://stackoverflow.com/users/4595675/abdulla-nilam)**
