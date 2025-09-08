# Instrucciones para instalar y ejecutar este proyecto

## Resumen técnico del proyecto

![Asset url](assets/evidencia.pdf)

Este es un proyecto Laravel 12 (PHP >= 8.2) con frontend compilado por Vite.

- __Backend__: Laravel `^12.0`, autenticación con `laravel/ui` (`Auth::routes()`), colas/sesiones/cache en base de datos, logging por stack.
- __Frontend__: Vite `^6`, Tailwind CSS 4, Bootstrap 5, Axios, y soporte para Vue 2 (algunas vistas pueden usar componentes Vue 2).
- __Assets__: entradas Vite en `resources/sass/app.scss` y `resources/js/app.js` configuradas en `vite.config.js`.
- __Base de datos__: por defecto `.env.example` usa `sqlite`; el README describe configuración MySQL (MAMP). Puedes usar cualquiera ajustando `.env`.

## Arquitectura (alto nivel)

- __Capas__:
  - Presentación: Blade + CSS/JS compilados por Vite.
  - Aplicación: Controladores en `app/Http/Controllers/*` y rutas en `routes/web.php`.
  - Dominio/Datos: Modelos Eloquent en `app/Models/*` y migraciones en `database/migrations/*`.
- __Assets__:
  - Estilos en `resources/sass/app.scss` (Bootstrap + Tailwind utilities).
  - Scripts en `resources/js/app.js` (Axios; soporte para componentes Vue 2).
- __Build__:
  - `vite.config.js` usa `laravel-vite-plugin` para generar `public/build/*` y `manifest.json`.

## API REST (JSON)

- Endpoints expuestos en `routes/api.php` usando `Route::apiResource`:
  - `GET /api/{recurso}`
  - `GET /api/{recurso}/{id}`
  - `POST /api/{recurso}`
  - `PUT/PATCH /api/{recurso}/{id}`
  - `DELETE /api/{recurso}/{id}`
- Recursos disponibles:
  - `animales`, `vegetales`, `preparados`, `agricultores`, `fincas`
- Controladores: `app/Http/Controllers/Api/*Controller.php`
- Subida de imágenes: usar `multipart/form-data` con campo `imagen`.
- Colección Postman REST: `docs/AMCA_REST.postman_collection.json` (variable `{{base_url}}`).

### Rutas principales (extraídas de `routes/web.php`)

- __Página web__
  - `GET /pagina_home` → `PaginaController@index`
  - `GET|POST /pagina_resultados/{texto_busqueda?}` → `PaginaController@resultados`
  - `GET /pagina_detalle/{id}/{tipo}` → `PaginaController@detalles`
- __Autenticación__
  - `Auth::routes()` (login, registro, reset password, etc. via `laravel/ui`)
- __Administrador__

## Requisitos previos

- **PHP 8.2+** (recomendado el de MAMP) y Composer (`/Applications/MAMP/bin/php/composer`).
- **Node.js y npm** instalados (idealmente LTS).
- **Base de datos**: SQLite (por defecto) o MySQL de MAMP.
- **MAMP** en macOS (opcional pero recomendado).

## Pasos para la instalación y ejecución

1. **Clona el repositorio** (si aún no lo has hecho):

   ```bash
   git clone <url-del-repositorio>
   cd sistema_amca
   ```

2. **Instala las dependencias de PHP**:

   ```bash
   /Applications/MAMP/bin/php/php8.2.26/bin/php /Applications/MAMP/bin/php/composer install
   ```
   ```bash 2
   composer install
   ```

3. **Copia el archivo de entorno y genera la clave de la aplicación**:

   ```bash
   cp .env.example .env
   /Applications/MAMP/bin/php/php8.2.26/bin/php artisan key:generate
   ```
   ```bash 2
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configura la base de datos**  
   Edita el archivo `.env` y ajusta las variables de conexión a la base de datos según tu configuración de MAMP/MySQL:

   ```
   # Opción A: SQLite (por defecto del .env.example)
   DB_CONNECTION=sqlite
   # (asegúrate de que exista database/database.sqlite si optas por SQLite)
   
   # Opción B: MySQL (MAMP)
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_tu_base
   DB_USERNAME=usuario
   DB_PASSWORD=contraseña
   ```

5. **Ejecuta las migraciones**:

   ```bash
   /Applications/MAMP/bin/php/php8.2.26/bin/php artisan migrate
   ```
   ```bash 2
   php artisan migrate
   ```

6. **Instala las dependencias de Node.js** (asegúrate de tener `npm` y `node` instalados):

   ```bash
   npm install
   ```

   > Si ves un error como `zsh: command not found: npm`, instala Node.js y npm desde [nodejs.org](https://nodejs.org/).

7. **Compila los assets del frontend**:

   ```bash
   npm run build
   ```

8. **Inicia el servidor de desarrollo de Laravel**:

   ```bash
   /Applications/MAMP/bin/php/php8.2.26/bin/php artisan serve --host=127.0.0.1 --port=8000
   ```
   ```bash 2
   php artisan serve --host=127.0.0.1 --port=8000
   ```

9. **Accede a la aplicación**  
   Abre tu navegador y visita: [http://127.0.0.1:8000](http://127.0.0.1:8000)

### Modo desarrollo (HMR)

En lugar de `npm run build`, puedes usar:

```bash
npm run dev
```

Esto arranca Vite en modo desarrollo con recarga en caliente.

---

## Solución de problemas (Troubleshooting)

- __npm: command not found__
  - Instala Node.js LTS desde https://nodejs.org/ y reabre la terminal.
- __Puerto 8000 en uso__
  - Cambia el puerto del servidor: `php artisan serve --host=127.0.0.1 --port=8001`.
- __SQLite: archivo no existe__
  - Crea el archivo y vuelve a migrar: `touch database/database.sqlite && php artisan migrate`.
- __Permisos en storage/bootstrap__
  - Asegura permisos de escritura: `chmod -R 775 storage bootstrap/cache` (o ajusta según tu entorno).
- __Vite warnings por Sass @import__
  - Son deprecaciones; no bloquean el build. Migrar a `@use`/`@forward` en el futuro.
- __Autenticación (vistas)__
  - Si faltan vistas de login/register, instalar `laravel/ui` y publicar scaffolding correspondiente.

---

## Versiones usadas (clave)

- PHP 8.2 (ej. `/Applications/MAMP/bin/php/php8.2.26/bin/php`).
- Laravel Framework ^12.0.
- laravel/ui ^4.6.
- Vite ^6.0.11 y laravel-vite-plugin ^1.2.0.
- Tailwind CSS ^4.0.0; Bootstrap ^5.2.3; Sass ^1.56.1.
- Vue ^2.7.16; Axios ^1.7.4.
- PHPUnit ^11.5.3.

> Nota: Las versiones exactas instaladas se fijan en `composer.lock` y `package-lock.json`.

---

## Changelog (documentación y arranque)

- 2025-08-19
  - Se enriqueció `README.md` con: propósito, arquitectura, rutas principales, versiones, instalación (SQLite/MySQL), ejecución (dev/prod), troubleshooting.
  - Se verificaron dependencias instaladas (`vendor/`, `node_modules/`).
  - Se ejecutaron migraciones (resultado: Nothing to migrate).
  - Se compiló frontend con `npm run build` (build exitoso).
  - Se inició servidor con `php artisan serve` en `127.0.0.1:8000`.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## Entorno de producción

Para desplegar en producción, asegúrate de:

- Configurar correctamente las variables de entorno en `.env` (APP_ENV=production, APP_DEBUG=false, etc.).
- Ejecutar las migraciones y seeders si es necesario:
  ```bash
  php artisan migrate --force
  php artisan db:seed --force
  ```
- Compilar los assets en modo producción:
  ```bash
  npm run build
  ```
- Limpiar y cachear la configuración y rutas:
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- Configurar correctamente los permisos de las carpetas `storage` y `bootstrap/cache`.

---

## Estructura del proyecto

- `app/` - Lógica principal de la aplicación (modelos, controladores, etc.)
- `routes/` - Definición de rutas web y API
- `resources/views/` - Vistas Blade (HTML)
- `public/` - Archivos públicos (imágenes, CSS, JS)
- `database/` - Migraciones, seeders y factories
- `config/` - Archivos de configuración
- `tests/` - Pruebas unitarias y funcionales

---

## Comandos útiles

- Limpiar cachés:
  ```bash
  php artisan cache:clear
  php artisan config:clear
  php artisan route:clear
  php artisan view:clear
  ```
- Ejecutar pruebas:
  ```bash
  php artisan test
  # o
  ./vendor/bin/phpunit
  ```
- Ejecutar servidor local:
  ```bash
  php artisan serve
  ```

---

## Notas sobre imágenes y archivos públicos

Las imágenes y archivos estáticos se encuentran en la carpeta `public/img/` y sus subcarpetas. Si subes imágenes desde la aplicación, asegúrate de que la carpeta tenga permisos de escritura.

---

## Contacto y soporte

Si tienes dudas, sugerencias o encuentras algún problema, puedes contactar al responsable del proyecto o abrir un issue en el repositorio.

---
