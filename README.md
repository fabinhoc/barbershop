# BARBERSHOP - Sistema de Agendamentos

 - Create, list, edit, delete professionals;
 - Create, list, edit, delete appointments;
 - Create, list, edit, delete users;
 - Access as (professional or admin);

# Requisites

 - Docker for windows 2.3.0.3;
 - Mysql 8.0;
 - Laravel 7+;
 - PHP 7.x
 - 
 ## Packages
 -  [JWT Auth](https://jwt-auth.readthedocs.io/en/develop/)

# Installation

 Create folder  

     $ ~/root/ mkdir barbershop && cd barbershop

Clone repository

    git clone https://github.com/fabinhoc/barbershop.git

Install docker dependencies

    $ ~/barbershop docker-compose up -d

Install laravel project

    $ ~/root/barbershop cd src
    $ ~/root/barbershop/src docker-compose exec php-fpm install
The project will available in http://localhost:4040/

# Frontend
The frontend is here https://github.com/fabinhoc/barbershop-frontend.git