# <p align="center">Desafio Maat</p>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Requerimientos

-   [Base de datos](https://laravel.com/docs/9.x/database#introduction) MariaDB 10.2+, MySQL 5.7+, PostgreSQL 9.6+, SQLite 3.8.8+, SQL Server 2017+.
-   [PHP](https://windows.php.net/downloads/releases/archives/) >=7.3.x & <=7.4.x.
-   [Composer](https://getcomposer.org/).

## Instalacion y Configuracion

Todos los comandos que se muestran a continuacion deben ejecutarse desde dentro de la carpeta del proyecto. A continuacion se indica paso a paso el proceso de instalacion y configuracion del proyecto.

-   Para instalar todos los paquetes necesarios en el proyecto es necesario ejecutar el siguiente comando:

```bash
    Composer install
```

-   Para crear el archivo de configuracion es necesario copiar .env.example y renombrarlo a .env:

```bash
    Desde CMD Windows: copy .env.example .env
    Desde BASH Linux: cp .env.example .env
```

-   Para nuestro proyecto es necesario contar con una base de datos en la cual almacenar nuestros registros. Usando Mysql podemos generar nuestra base de datos con los siguientes comandos:

```bash
    mysql -u root
    CREATE DATABASE desafio_maaat;
    SHOW DATABASES;
    EXIT;
```

-   Abrir el archivo .env y editar con los siguientes valores las lineas que corresponden a la configuracion de la base de datos del proyecto:

```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=desafio_maat
    DB_USERNAME=root
    DB_PASSWORD=
```

-   Antes de inicializar nuestro proyecto es necesario generar una clave de proyecto dentro de nuestro archivo .env. Para generar nuestra clave de proyecto es necesario ejecutar el siguiente comando:

```bash
    php artisan key:generate
```

## Inicializacion

-   Dentro de la carpeta del proyecto se debe ejecutar el siguiente comando:

```bash
    php artisan serve
```

A partir desde este momento podemos acceder a la aplicacion atraves de un navegador web con la siguiente direccion url "http://localhost:8000/"

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
