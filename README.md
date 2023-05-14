# Prueba Técnica: Consulta de Humedad de Ciudades

En esta prueba técnica se implementó una página web que permite consultar la humedad de las ciudades de Miami, Orlando y Nueva York, mostrando los resultados en un mapa. Además, se guarda un historial de las consultas realizadas, el cual puede ser consultado a través de un enlace en la página.

## Tecnologías utilizadas

- Laravel 8
- Bootstrap 5
- Leaflet.js
- OpenWeatherMap API
- League/CSV para el manejo de archivos CSV

## Instalación y configuración

Para instalar el proyecto en local, seguir los siguientes pasos:

1. Clonar el repositorio: `git clone https://github.com/<tu-usuario>/prueba-tecnica-consultahumedad.git`
2. Instalar las dependencias del proyecto: `composer install`
3. Copiar el archivo `.env.example` a `.env` y configurar las credenciales de la base de datos y la API de OpenWeatherMap.

## Uso

Para acceder a la página web, ejecutar el comando `php artisan serve` y abrir la URL `http://localhost:8000` en un navegador web.

La página muestra un mapa con los marcadores de las ciudades de Miami, Orlando y Nueva York, y un cuadro de diálogo para mostrar la información de la humedad de las ciudades al hacer clic en los marcadores.

Además, se guarda un historial de las consultas realizadas, el cual puede ser consultado haciendo clic en el enlace "Historial" en la parte izquierda de la página.

## Estructura del proyecto

La estructura del proyecto es la siguiente:

- `app/Http/Controllers`: contiene los controladores de la aplicación.
- `app/Http/Requests`: contiene las clases para validar las peticiones HTTP.
- `config`: contiene la configuración de la aplicación.
- `public`: contiene los archivos públicos de la aplicación (CSS, JS, imágenes, etc.).
- `resources/views`: contiene las vistas de la aplicación.
- `routes/web.php`: contiene las rutas de la aplicación.

## Créditos

Este proyecto fue creado por Lina Hueso como parte de una prueba técnica para browser travel solutions.