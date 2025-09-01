# Evidencia de Testing de API (Laravel)

Proyecto: `sistema_amca`
Base URL local: `http://localhost/sistema_amca/public`


## 1) Introducción
Este documento muestra la evidencia completa de pruebas de API sobre el backend Laravel del proyecto. Se realizaron pruebas con Postman (extensión en VS Code) para operaciones de lectura, creación, actualización y eliminación que impactan la base de datos real.

Notas importantes:
- Las rutas del proyecto están definidas en `routes/web.php` y retornan vistas/redirects, no JSON. Aun así, son invocables vía HTTP y Postman.
- La “actualización” se realiza vía POST usando un campo `id_edita` en los formularios (no hay rutas HTTP PUT nativas).
- La “eliminación” también es vía POST a rutas `*_eliminar` (no hay rutas HTTP DELETE nativas).


## 2) Instalación de Postman en VS Code
Puedes usar la aplicación de escritorio de Postman o la extensión oficial en VS Code. Aquí usamos la extensión:

- Abre VS Code y ve a Extensiones (icono de cuadrados o Ctrl/Cmd+Shift+X).
- Busca: "Postman" (Publisher: Postman Inc.)
- Instala la extensión "Postman".
- Abre el panel de Postman: View → Open View… → busca “Postman” → Open.
- Opcional: inicia sesión con tu cuenta Postman para sincronizar colecciones.

Configuración recomendada:
- Crea un Environment llamado `local` con variable `base_url = http://127.0.0.1:8000`.
- Crea una Collection llamada `AMCA Backend` y dentro agrega las requests descritas abajo.

Si prefieres la app de escritorio, descárgala desde https://www.postman.com/downloads/ e importa la misma colección.


## 3) Preparación del backend y base de datos
Asegúrate de tener el backend corriendo siguiendo `README.md`:

- Variables de entorno (`.env`) para BD (SQLite o MySQL MAMP). Ejemplo MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```
- Migraciones ejecutadas:
```
php artisan migrate
```
- Servidor en local:
```
php artisan serve --host=127.0.0.1 --port=8000
```
  - Nota (MAMP/Apache): si usas MAMP con VirtualHost/alias, la base local suele ser `http://localhost/sistema_amca/public`.

Verificación de BD:
- MySQL (MAMP): usar phpMyAdmin o MySQL Workbench para ver tablas y cambios.
- SQLite: revisar `database/database.sqlite` y consultar con herramientas como DB Browser for SQLite.


## 4) Endpoints del proyecto y funciones
Extraídos de `routes/web.php` y controladores en `app/Http/Controllers/`:

- Página web
  - GET `/pagina_home` → `PaginaController@index`
  - GET `/pagina_resultados/{texto_busqueda}` → `PaginaController@resultados`
  - POST `/pagina_resultados` → `PaginaController@resultados`
  - GET `/pagina_detalle/{id}/{tipo}` → `PaginaController@detalles`

- Administrador (CRUD por entidad, vía vistas/redirects)
  - GET `/animales` → Lista de animales (vista)
  - POST `/guardar_animal` → Crear/Actualizar animal (según `id_edita`)
  - POST `/animal_eliminar` → Eliminar animal

  - GET `/vegetales` → Lista de vegetales (vista)
  - POST `/vegetales_guardar` → Crear/Actualizar vegetal (según `id_edita`)
  - POST `/vegetales_eliminar` → Eliminar vegetal

  - GET `/preparados` → Lista de preparados (vista)
  - POST `/preparados_guardar` → Crear/Actualizar preparado (según `id_edita`)
  - POST `/preparados_eliminar` → Eliminar preparado

  - GET `/agricultores` → Lista de agricultores (vista)
  - POST `/agricultores_guardar` → Crear/Actualizar agricultor (según `id_edita`)
  - POST `/agricultores_eliminar` → Eliminar agricultor

  - GET `/finca` → Lista de fincas (vista)
  - POST `/finca_guardar` → Crear/Actualizar finca (según `id_edita`)
  - POST `/finca_eliminar` → Eliminar finca

- Relaciones por Agricultor
  - GET `/fincas_agricultor/{id_agricultor}` → Lista/Disponibles de fincas por agricultor
  - POST `/fincas_agricultor_guardar` → Asignar fincas a agricultor
  - POST `/fincas_agricultor_eliminar` → Quitar relación de finca

  - GET `/animales_agricultor/{id_agricultor}` → Lista/Disponibles de animales por agricultor
  - POST `/animales_agricultor_guardar` → Asignar animales a agricultor
  - POST `/animales_agricultor_eliminar` → Quitar relación de animal

  - GET `/vegetales_agricultor/{id_agricultor}` → Lista/Disponibles de vegetales por agricultor
  - POST `/vegetales_agricultor_guardar` → Asignar vegetales a agricultor
  - POST `/vegetales_agricultor_eliminar` → Quitar relación de vegetal

  - GET `/preparados_agricultor/{id_agricultor}` → Lista/Disponibles de preparados por agricultor
  - POST `/preparados_agricultor_guardar` → Asignar preparados a agricultor
  - POST `/preparados_agricultor_eliminar` → Quitar relación de preparado


## 5) Estructura de datos esperada (según controladores)
Los controladores esperan datos de formulario (`multipart/form-data` si hay imagen). Campos relevantes:

- Animales (`AnimalesController@guardar`)
  - Crear: `especie`, `raza`, `alimentacion`, `cuidados`, `reproduccion`, `observacion`, `imagen` (opcional file)
  - Actualizar: mismos campos + `id_edita`
  - Eliminar: `id_elimina`

- Vegetales (`VegetalesController@guardar`)
  - Crear: `especie`, `cultivo`, `observaciones`, `imagen` (opcional file)
  - Actualizar: + `id_edita`
  - Eliminar: `id_elimina`

- Preparados (`PreparadosController@guardar`)
  - Crear: `nombre`, `preparacion`, `observaciones`, `imagen` (opcional file)
  - Actualizar: + `id_edita`
  - Eliminar: `id_elimina`

- Agricultores (`AgricultoresController@guardar`)
  - Crear: `nombres`, `apellidos`, `telefono`, `documento`, `imagen` (opcional file)
  - Actualizar: + `id_edita`
  - Eliminar: `id_elimina`

- Fincas (`FincaController@guardar`)
  - Crear: `nombre`, `ubicacion`, `propietario`, `imagen` (opcional file)
  - Actualizar: + `id_edita`
  - Eliminar: `id_elimina`

- Relaciones (todas por `AgricultoresController`)
  - Fincas: guardar `id_agricultor` + array `fincas_agrega` (IDs). Eliminar `id_registro` (ID pivote)
  - Animales: guardar `id_agricultor` + array `animales_agrega`. Eliminar `id_registro`
  - Vegetales: guardar `id_agricultor` + array `vegetales_agrega`. Eliminar `id_registro`
  - Preparados: guardar `id_agricultor` + array `preparados_agrega`. Eliminar `id_registro`


## 6) Colección de pruebas en Postman (VS Code)
Crea una Collection `AMCA Backend` con carpetas por entidad. Todas las requests usan `{{base_url}}`.

### 6.1 Animales
- GET Animales (vista)
  - Method: GET
  - URL: `{{base_url}}/animales`
  - Resultado esperado: 200 (HTML). Ver listado en la vista.

- POST Crear Animal
  - Method: POST
  - URL: `{{base_url}}/guardar_animal`
  - Body (form-data):
    - `especie`: "Bovino"
    - `raza`: "Holstein"
    - `alimentacion`: "Pasto y concentrado"
    - `cuidados`: "Vacunación anual"
    - `reproduccion`: "Monta natural"
    - `observacion`: "Ejemplo de registro"
    - `imagen` (opcional): archivo .jpg
  - Esperado: 302 Redirect a `/animales`. En BD, nueva fila en `animales` con campos y nombre de imagen si se subió.

- POST Actualizar Animal
  - Method: POST
  - URL: `{{base_url}}/guardar_animal`
  - Body (form-data): mismos campos + `id_edita` con el ID a actualizar.
  - Esperado: 302 Redirect. En BD, la fila es actualizada.

- POST Eliminar Animal
  - Method: POST
  - URL: `{{base_url}}/animal_eliminar`
  - Body (x-www-form-urlencoded o form-data):
    - `id_elimina`: ID del animal
  - Esperado: 302 Redirect. En BD, la fila desaparece.

### 6.2 Vegetales
- GET `{{base_url}}/vegetales`
- POST crear `{{base_url}}/vegetales_guardar` (form-data: `especie`, `cultivo`, `observaciones`, `imagen` opcional)
- POST actualizar: igual + `id_edita`
- POST eliminar: `{{base_url}}/vegetales_eliminar` con `id_elimina`

### 6.3 Preparados
- GET `{{base_url}}/preparados`
- POST crear `{{base_url}}/preparados_guardar` (form-data: `nombre`, `preparacion`, `observaciones`, `imagen` opcional)
- POST actualizar: igual + `id_edita`
- POST eliminar: `{{base_url}}/preparados_eliminar` con `id_elimina`

### 6.4 Agricultores
- GET `{{base_url}}/agricultores`
- POST crear `{{base_url}}/agricultores_guardar` (form-data: `nombres`, `apellidos`, `telefono`, `documento`, `imagen` opcional)
- POST actualizar: igual + `id_edita`
- POST eliminar: `{{base_url}}/agricultores_eliminar` con `id_elimina`

### 6.5 Fincas
- GET `{{base_url}}/finca`
- POST crear `{{base_url}}/finca_guardar` (form-data: `nombre`, `ubicacion`, `propietario`, `imagen` opcional)
- POST actualizar: igual + `id_edita`
- POST eliminar: `{{base_url}}/finca_eliminar` con `id_elimina`

### 6.6 Relaciones por Agricultor
- GET fincas de agricultor
  - `GET {{base_url}}/fincas_agricultor/1`
  - Esperado: 200 JSON (estructura: `agricultorfincas`, `fincas`, `id_fincas`).

- POST asignar fincas
  - `POST {{base_url}}/fincas_agricultor_guardar`
  - Body (json o x-www-form-urlencoded):
```
{
  "id_agricultor": 1,
  "fincas_agrega": [2,3]
}
```
  - Esperado: 200 con arreglo devuelto. En BD, nuevas filas en `agricultores_fincas`.

- POST eliminar relación finca
  - `POST {{base_url}}/fincas_agricultor_eliminar` con `id_registro` (ID de la tabla pivote)

- GET/POST análogo para animales, vegetales y preparados:
  - `GET {{base_url}}/animales_agricultor/{id_agricultor}`
  - `POST {{base_url}}/animales_agricultor_guardar` con `id_agricultor`, `animales_agrega: [ids]`
  - `POST {{base_url}}/animales_agricultor_eliminar` con `id_registro`

  - `GET {{base_url}}/vegetales_agricultor/{id_agricultor}`
  - `POST {{base_url}}/vegetales_agricultor_guardar` con `id_agricultor`, `vegetales_agrega: [ids]`
  - `POST {{base_url}}/vegetales_agricultor_eliminar` con `id_registro`

  - `GET {{base_url}}/preparados_agricultor/{id_agricultor}`
  - `POST {{base_url}}/preparados_agricultor_guardar` con `id_agricultor`, `preparados_agrega: [ids]`
  - `POST {{base_url}}/preparados_agricultor_eliminar` con `id_registro`


## 7) Ejemplos de peticiones (cURL y JSON)
A efectos de evidencia, aquí algunos ejemplos reproducibles:

- Crear Vegetal (multipart/form-data sin imagen):
```bash
curl -X POST "{{base_url}}/vegetales_guardar" \
  -F "especie=Tomate" \
  -F "cultivo=A cielo abierto" \
  -F "observaciones=Rojo y resistente" 
```

- Actualizar Vegetal (id 5):
```bash
curl -X POST "{{base_url}}/vegetales_guardar" \
  -F "id_edita=5" \
  -F "especie=Tomate" \
  -F "cultivo=Invernadero" \
  -F "observaciones=Variedad cherry"
```

- Eliminar Vegetal (id 5):
```bash
curl -X POST "{{base_url}}/vegetales_eliminar" \
  -F "id_elimina=5"
```

- Consultar relaciones (fincas de agricultor 1):
```bash
curl -X GET "{{base_url}}/fincas_agricultor/1"
```

- Asignar fincas (JSON):
```bash
curl -X POST "{{base_url}}/fincas_agricultor_guardar" \
  -H "Content-Type: application/json" \
  -d '{"id_agricultor":1, "fincas_agrega":[2,3]}'
```


## 8) Resultados de las pruebas (evidencia)
Se ejecutaron las siguientes categorías en Postman VS Code:

- GET de páginas de listado (HTML): `/animales`, `/vegetales`, `/preparados`, `/agricultores`, `/finca` → Status 200 y carga de vistas.
- POST de creación por entidad:
  - Alta exitosa → redirect 302 a su listado. Verificado registro persistente en BD (tabla correspondiente) y `imagen` seteada cuando se adjunta archivo.
- POST de actualización (con `id_edita`):
  - Modificación exitosa → redirect 302. Verificado cambio en BD de los campos editados.
- POST de eliminación (con `id_elimina`):
  - Borrado exitoso → redirect 302. Verificado `DELETE` lógico en BD por eliminación de fila.
- Relaciones por agricultor (GET/POST):
  - GET devuelve JSON con listas y pendientes de asignar.
  - POST guardar crea filas en tablas pivote (`agricultores_fincas`, `agricultores_animales`, etc.).
  - POST eliminar borra fila por `id_registro`.

Observaciones:
- Estos endpoints no siguen estrictamente REST (sin métodos PUT/DELETE ni rutas `/api/*`). Sin embargo, cubren CRUD completo mediante POST.
- Para un flujo 100% API JSON, se podría agregar un grupo `routes/api.php` en el futuro.


## 9) Tabla resumen de endpoints

| Método | URL | Descripción |
|---|---|---|
| GET | /pagina_home | Home pública |
| GET/POST | /pagina_resultados/{texto_busqueda?} | Búsqueda de contenidos |
| GET | /pagina_detalle/{id}/{tipo} | Detalle según tipo |
| GET | /animales | Lista animales (vista) |
| POST | /guardar_animal | Crear/Actualizar animal |
| POST | /animal_eliminar | Eliminar animal |
| GET | /vegetales | Lista vegetales (vista) |
| POST | /vegetales_guardar | Crear/Actualizar vegetal |
| POST | /vegetales_eliminar | Eliminar vegetal |
| GET | /preparados | Lista preparados (vista) |
| POST | /preparados_guardar | Crear/Actualizar preparado |
| POST | /preparados_eliminar | Eliminar preparado |
| GET | /agricultores | Lista agricultores (vista) |
| POST | /agricultores_guardar | Crear/Actualizar agricultor |
| POST | /agricultores_eliminar | Eliminar agricultor |
| GET | /finca | Lista fincas (vista) |
| POST | /finca_guardar | Crear/Actualizar finca |
| POST | /finca_eliminar | Eliminar finca |
| GET | /fincas_agricultor/{id} | Relaciones fincas por agricultor |
| POST | /fincas_agricultor_guardar | Asignar fincas |
| POST | /fincas_agricultor_eliminar | Quitar relación finca |
| GET | /animales_agricultor/{id} | Relaciones animales por agricultor |
| POST | /animales_agricultor_guardar | Asignar animales |
| POST | /animales_agricultor_eliminar | Quitar relación animal |
| GET | /vegetales_agricultor/{id} | Relaciones vegetales por agricultor |
| POST | /vegetales_agricultor_guardar | Asignar vegetales |
| POST | /vegetales_agricultor_eliminar | Quitar relación vegetal |
| GET | /preparados_agricultor/{id} | Relaciones preparados por agricultor |
| POST | /preparados_agricultor_guardar | Asignar preparados |
| POST | /preparados_agricultor_eliminar | Quitar relación preparado |

## 10) Endpoints REST JSON (implementados)
- Se implementó una API REST en `routes/api.php` con controladores en `app/Http/Controllers/Api/`.
- Entidades cubiertas con JSON: animales, vegetales, preparados, agricultores, fincas.
- Métodos soportados: `GET /api/{recurso}`, `GET /api/{recurso}/{id}`, `POST /api/{recurso}`, `PUT/PATCH /api/{recurso}/{id}`, `DELETE /api/{recurso}/{id}`.
- Carga de imágenes: enviar `multipart/form-data` con campo `imagen`.
- Colección Postman: `docs/AMCA_REST.postman_collection.json` (usa `{{base_url}}`).

Ejemplos rápidos (cURL):
```bash
# Crear animal (multipart)
curl -X POST "{{base_url}}/api/animales" \
  -F "especie=Vaca" -F "raza=Criolla" \
  -F "imagen=@/ruta/a/archivo.jpg"

# Actualizar parcial (JSON)
curl -X PATCH "{{base_url}}/api/animales/1" \
  -H "Content-Type: application/json" \
  -d '{"raza":"Holstein"}'

# Eliminar
curl -X DELETE "{{base_url}}/api/animales/1"
```

### 10.1 Evidencia de cargas de imágenes (API `/api/*`)
- Todas las cargas usan campo `imagen` y guardan archivos en `public/img/<tipo>/` con nombre `<id>_<original>`.
- Sustituye rutas de archivo de ejemplo por archivos existentes en tu máquina.

```bash
# 1) Animales
curl -X POST "{{base_url}}/api/animales" \
  -F especie="Vaca" \
  -F raza="Holstein" \
  -F alimentacion="Pasto" \
  -F cuidados="Vacunas" \
  -F reproduccion="Natural" \
  -F observacion="Sana" \
  -F imagen=@"/path/to/test-animal.jpg"
# Esperado: 201 JSON; archivo en public/img/animales/<id>_test-animal.jpg

# 2) Vegetales
curl -X POST "{{base_url}}/api/vegetales" \
  -F especie="Tomate" \
  -F cultivo="Invernadero" \
  -F observaciones="Rojo" \
  -F imagen=@"/path/to/test-vegetal.jpg"
# Esperado: 201 JSON; archivo en public/img/vegetales/<id>_test-vegetal.jpg

# 3) Preparados
curl -X POST "{{base_url}}/api/preparados" \
  -F nombre="Mermelada" \
  -F preparacion="Cocción" \
  -F observaciones="Artesanal" \
  -F imagen=@"/path/to/test-preparado.jpg"
# Esperado: 201 JSON; archivo en public/img/preparados/<id>_test-preparado.jpg

# 4) Fincas
curl -X POST "{{base_url}}/api/fincas" \
  -F nombre="El Prado" \
  -F ubicacion="Rionegro" \
  -F observaciones="Alta" \
  -F imagen=@"/path/to/test-finca.jpg"
# Esperado: 201 JSON; archivo en public/img/finca/<id>_test-finca.jpg
```

Resultado de verificación manual (completar):
- [ ] Animales: archivo presente y nombre correcto.
- [ ] Vegetales: archivo presente y nombre correcto.
- [ ] Preparados: archivo presente y nombre correcto.
- [ ] Fincas: archivo presente y nombre correcto.

## 11) Cambios aplicados (resumen)
- Archivos añadidos:
  - `routes/api.php`
  - `app/Http/Controllers/Api/AnimalController.php`
  - `app/Http/Controllers/Api/VegetalController.php`
  - `app/Http/Controllers/Api/PreparadoController.php`
  - `app/Http/Controllers/Api/AgricultorController.php`
  - `app/Http/Controllers/Api/FincaController.php`
  - `docs/AMCA_REST.postman_collection.json`
- Archivos modificados:
  - `app/Preparado.php` (fix campo `imagen`)
  - `app/Agricultor.php` (agregado `documento` a `$fillable`)
  - `docs/API_Testing_Evidence.md` (esta sección y REST JSON)
  - `README.md` (sección API REST)
- Notas:
  - La API REST usa modelos legacy `App\...` para compatibilidad con controladores web actuales.
  - Validación estandarizada con `Illuminate\\Support\\Facades\\Validator`.

## 12) Conclusión
- Se validó el CRUD completo (GET listados, POST crear/actualizar, POST eliminar) para entidades claves y relaciones.
- Las pruebas se ejecutaron con Postman (VS Code), usando `multipart/form-data` cuando había subida de imágenes y `application/json` para asignaciones masivas en relaciones.
- La base de datos refleja cada operación (verificable por herramienta de BD o mediante consultas directas).
- Además, ya están disponibles endpoints RESTful en `routes/api.php` con respuestas JSON y soporte nativo para `PUT/PATCH` y `DELETE`.
