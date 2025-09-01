# Tareas de Desarrollo - Sistema AMCA

## 1. Análisis y Diseño
- [ ] Revisar y actualizar el diagrama de componentes
- [ ] Documentar el mapa de navegación de la aplicación
- [ ] Identificar y documentar las capas de la aplicación
  - [ ] Capa de presentación
  - [ ] Capa de negocio
  - [ ] Capa de acceso a datos

## 2. Configuración del Entorno
- [ ] Configurar servidor web (Apache/Nginx)
- [ ] Configurar base de datos
- [ ] Establecer entorno de desarrollo local
- [ ] Configurar entorno de pruebas
- [ ] Configurar entorno de producción

## 3. Control de Versiones
- [ ] Inicializar repositorio Git
- [ ] Crear ramas de desarrollo
- [ ] Establecer flujo de trabajo (Git Flow)
- [ ] Configurar .gitignore
- [ ] Documentar convenciones de commits

## 4. Estructura del Proyecto
- [x] Organizar código en paquetes lógicos
- [x] Configurar autoloading
- [ ] Establecer estructura de directorios
  - [x] app/Http/Controllers
  - [x] app/Models
  - [ ] resources/views
  - [ ] database/migrations
  - [ ] tests/Feature
  - [ ] tests/Unit

## 5. Desarrollo de Módulos
- [ ] Módulo de Gestión de Agricultores
  - [ ] CRUD de Agricultores
  - [ ] Asociación con Fincas
  - [ ] Gestión de Animales
  - [ ] Gestión de Vegetales
  - [ ] Gestión de Preparados

## 6. Seguridad
- [ ] Implementar autenticación
- [ ] Configurar autorización (roles y permisos)
- [ ] Validación de datos de entrada
- [ ] Protección CSRF
- [ ] Cifrado de datos sensibles
- [ ] Logs de seguridad

## 7. Calidad de Código
- [ ] Configurar estándares de codificación (PSR)
- [ ] Configurar PHP_CodeSniffer
- [ ] Configurar PHPStan/PHP Insights
- [ ] Documentar código (PHPDoc)
- [ ] Revisión de código

## 8. Pruebas
- [ ] Configurar PHPUnit
- [ ] Escribir pruebas unitarias
- [ ] Escribir pruebas de integración
- [ ] Pruebas de aceptación
- [ ] Pruebas de rendimiento

## 9. Documentación
- [ ] Documentación técnica
- [ ] Manual de usuario
- [ ] Guía de instalación
- [ ] Guía de despliegue
- [ ] Documentación de API (si aplica)

## 10. Despliegue
- [ ] Configurar entorno de producción
- [ ] Automatizar despliegues
- [ ] Configurar backups
- [ ] Monitoreo y métricas
- [ ] Plan de rollback

## 11. Mantenimiento
- [ ] Documentar procedimientos de soporte
- [ ] Establecer ciclo de vida de parches
- [ ] Plan de actualizaciones

---

## Progreso General
- [ ] 0% Completado

## Notas
- Revisar periódicamente el progreso
- Actualizar el estado de las tareas a medida que se completen
- Documentar cualquier desviación de los requisitos originales

---

## Registro de cambios recientes

- [x] Estandarizado uso de modelos bajo `App/Models/*` en controladores (web y API).
- [x] Corregido manejo de carga de imágenes usando `public_path()` y creación del directorio si no existe (`img/animales`, `img/vegetales`, `img/preparados`, `img/finca`, `img/agricultores`).
- [x] Alineados modelos pivote con migraciones:
  - `AgricultorAnimal` → tabla `agricultores_animales` con columnas `id_agricultor`, `id_animal`.
  - `AgricultorFinca` → tabla `agricultores_fincas` con columnas `id_agricultor`, `id_finca`.
- [x] Corregida lógica en `PaginaController` para preparados y pivotes:
  - Eliminadas variable-variables; uso de `Preparado` para consultas pendientes.
  - Guardar/eliminar de relaciones usa los modelos pivote correctos y columnas (`id_animal`, `id_vegetal`, `id_preparado`).
- [x] Ejecutado `composer dump-autoload -o` (vía PHP de MAMP) y `php artisan route:list` sin errores de rutas.
- [x] Resuelto PSR-4 de controladores de autenticación: movidos a `app/Http/Controllers/Auth/` y reemplazado `RouteServiceProvider::HOME` por `'/home'` donde aplicaba.

- [x] Eliminado modelo legacy `app/User.php` (se usa `App/Models/User`).

- [x] Alineados pivotes `AgricultorVegetal` y `AgricultorPreparado` con sus migraciones:
  - `AgricultorVegetal` → tabla `agricultores_vegetales`, columnas `id_agricultor`, `id_vegetal`, relaciones con FKs explícitos.
  - `AgricultorPreparado` → tabla `agricultores_preparados`, columnas `id_agricultor`, `id_preparado`, relaciones con FKs explícitos.

Pendientes:
 - [ ] Pruebas manuales de carga de imágenes en endpoints API y vistas.
 - [x] Revisar y limpiar `app/User.php` si ya se usa `App\Models\User` en toda la app.
