# Studio RF Pro - Project
CMS and API

## Installation

1. Download and install [Composer](https://getcomposer.org/doc/00-intro.md).

2. Download and install [GIT](https://git-scm.com/downloads).

3. Project Clone
```bash
git clone https://gitlab.com/DionataNunesGarcia/laticineos.git
```

## Docker Compose CakePHP 4 Setup

### Features
* mailhog
* MySQL
* nginx
* php-fpm

Using a `docker-compose.yaml` file

Clone this repo and rename `~/env.example` to `.env` then run



```
docker-compose build
```

```
composer install 
```

Edit `config/app_local.php`

```php
  // config/app_local.php
 'default' => [
            /* change values to match .env values
             *  DB_HOST=mysql
             *  DB_DATABASE=studio_rf
             *  DB_USERNAME=studio_rf
             *  DB_PASSWORD=studio_rf
             */
            'host' => 'mysql',
            'username' => 'studio_rf',
            'password' => 'studio_rf',
            'database' => 'studio_rf',
        ],
 'EmailTransport' => [
        'default' => [
            // change host to mailhog
            'host' => 'mailhog',
            // port to whatever is specified in .env MAIL_PORT=1025
            'port' => 1025,
            // force the use of Smtp by adding the following
            'className' => SmtpTransport::class, 
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
```

```
docker-compose up
```


Update project dependence using composer
```bash
composer install
```

### Import dump database
#### Enter in container database
```bash
docker-compose exec database bash
```

#### Restore database
```bash
mysql -uroot -pstudio_rf studio_rf < _dumps/last_dump.sql 
```

Docker base [here](https://github.com/toggenation/CakePHP4-MailHog-Nginx-PHP)

## Config database

Read and edit `config/app.php` with connection data.
If environment is local, copy `config/app_local.example.php` and rename to `config/app_local.php`, after config connections data.

To update scripts database, is used the [migrations](https://book.cakephp.org/migrations/2/pt/index.html#migrations), para saber mais só entrar no link https://book.cakephp.org/migrations/2/pt/index.html#migrations

## Local Server
To deploy local machine, execute the command
```bash
bin/cake server -p 8765
```

## Server Update
Para atualizar os dados no servidor, só executar o comando pull do git apontando para a branch main dentro da raiz do projeto `var/www/html/`

```bash
git pull origin main
```

To check if exist scripts

```bash
bin/cake migrations status
```

To execute all migrations scripts, execute command

```bash
bin/cake migrations migrate
```

To cache clear

```bash
bin/cake cache clear_all
```

