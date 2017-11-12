<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Link publico del proyecto (URL)
http://infocentropadrechacinvdlp.esy.es/

## Requerimientos

- PHP >= 5.5
- MySQL
- Git
- Composer

## Instalación

**Git**
```shell
git clone https://github.com/rafaelchirel/infocentro.git
```

- Dentro del proyecto (en la raiz), crear un archivo llamado `.env`
- Luego copiar todo el contenido de `.env.example` y pegarlo en el nuevo archivo creado `.env`
- Desde phpMyAdmin, importar base de datos (db), se encuentra en la carpeta BDD del proyecto.
- Asociar las credencias de la base de datos en el archivo `.env`
```php
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=infocentro
	DB_USERNAME=root
	DB_PASSWORD=
```

**Composer**
```shell
composer install
php artisan key:generate
php artisan serve
```

## Colaborar

Cualquier aportación vía Pull-Request  :)
