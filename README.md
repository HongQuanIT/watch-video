WATCH PROJECT

===================

# Introduction #

BE
# Prerequisites #

docker
mysql 8.0.28
mongodb
laravel 8.0
php 7.4.29
...

# Installation #
**Insall Projects Manual**

 - Clone project
 - At folder project:
 - Copy config file `.env.examle` to `.env`
 - `composer install` **or** `composer install --ignore-flatform-reqs`

**Install project with docker**

Install and use (google)
At folder project:

 - Copy config file `.env.examle` to `.env`
 - `docker-compose up --build`

**Install project with pim shell script**

Require: must install docker
At folder project:

 - `pim install`
 - DB MySQL: user `admin` pass `password`

**Command use for pim shell script**

 - `pim up` : Runs docker compose to up services
 - `pim down` : Down all services in docker
 - `pim exec` : Opens bash with user in docker exec nginx
 - `pim clear` : Clear cache route,view,config and dump-autoload...

 **Download json config  postman**
 Link : {{url}}/postman

**User guide postman**

 # Docs #
