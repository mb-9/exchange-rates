Laravel Countries And Exchange Rates Application
========================
This is a laravel application with list of countries, and detail of each country with exchange rate.

Requirements
------------

  * PHP 8.2.4 or higher;

Installation
------------

```bash
# clone the code repository and install its dependencies
$ git clone https://github.com/mb-9/exchage-rates.git my_project
$ cd my_project/
$ composer install
```

Database
--------

Set up connection string in .env and run 

```bash
php artisan migrate
```

Scheduling
--------

There are two tasks that are scheduled every day

- downloading countries
- downloading exchange rates 

Add cron entry to schedule the tasks:

```bash
* * * * * cd /my_project && php artisan schedule:run >> /dev/null 2>&1
```
