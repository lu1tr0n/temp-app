
<p  align="center">
	<h1  align="center">Web Application - Temp App</h1>
	<br>
</p>
 
Este repositorio de muestra es para fines de demostración y mi forma de trabajar sobre sobre el framework Yii2.

La idea básica es crear una aplicación web basada en MVC y demostrar cómo funciona el consumir una API con Yii2.
 

Requerimientos
------------

 - El requisito mínimo de este proyecto es que su servidor web sea compatible con PHP 5.4.0 o mayor.
 - Tener instalado [composer](http://getcomposer.org).

  
Instalación
------------ 

 - Abrir una terminal, en la ubicación del proyecto
 - Ejecutar el comando `composer install`
 

## Ejecutar el proyecto
El framework de yii2 posee un servidor interno que permite ejecutar la aplicación sin la necesidad de instalar un tercero.
~~~

php yii serve

~~~
 
Pero si desean ejecutar la aplicación web en un servidor como Nginx, Apache u lighttpd, solo se necesita colocar la carpeta del proyecto en la ubicación de la carpeta publica del servidor e ir a la url:
~~~

http://localhost/temp-app/web/

~~~

## Comandos en consola
Se creo un comando que inserta datos de prueba en la base de datos, son para fines de testing.
~~~

php yii temp/add -u=prueba -p=prueba -a=6
~~~
**Argumentos:**
~~~
php yii temp/add -u=prueba -p=prueba <cantidad>
~~~
**Opciones:**
~~~
-u:	usuario
-p: contraseña
-a: Cantidad de registros a generar

~~~
> Proyecto aun en **desarrollo**