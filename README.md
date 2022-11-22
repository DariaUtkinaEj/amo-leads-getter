## amo-leads-getter - this is my test project.
The task is:
"Создать приложение (желательно в докере) на Laravel, которое будет выгружать сделки и связанные с ними сущности из amoCRM в базу данных. Способ реализации по желанию

Требования:

⁃ Использовать тестовую учётку, зарегистрировавшись на https://www.amocrm.ru
⁃ В работе с API использовать библиотеку https://github.com/amocrm/amocrm-api-php
⁃ БД на PostgreSQL
⁃ В базе не должно быть дублей: 1 сущность - 1 запись
⁃ Обеспечить целостность данных
Прислать ссылку на репозиторий с кодом".

## Tools:
* Nginx - is for webserver
* PostgreSQL 10-12.3 - is for database
* PHP8.0 
* Laravel8 
* composer is for creating laravel-project
* artisan 
* docker & docker-compose

## Installation:

* The first way is installation without Docker:

1. Clone this repository: git clone https://github.com/DariaUtkinaEj/amo-leads-getter
2. Copy .env file: cp .env.example .env
3. Set the environment variables in .env file
4. This and all next commands should be run in / project directory. Run migration: php artisan migrate
5. Run this command to get data from amo api: php artisan update:lead

// using live-server, open server,pgadmin or adminer you can see database with all tables in your browser.


* The second way to get the app with docker&docker-compose tools:
1. Clone this repository: git clone https://github.com/DariaUtkinaEj/amo-leads-getter
2. Make sure you have docker installed on your local machine, you do not need to have php / postgreSQL / Laravel / webserver installed on your machine
3. Copy .env file: cp .env.example .env
4. Set the environment variables in .env file
5. Run command: docker-compose up --build -d
6. Run the container in bash mode: docker exec -it php /bin/sh
7. Inside this container now you can run all the commands as if you are on local environment:
Run: Install composer dependencies: composer install
8. Run: php artisan migrate
9. Run this command: php artisan update:lead



