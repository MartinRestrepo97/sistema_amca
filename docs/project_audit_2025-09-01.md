# AMCA Laravel Project Audit — 2025-09-01

## Overview
This document summarizes issues, risks, and recommendations identified across the Laravel project located at `/Applications/MAMP/htdocs/Copia de sistema_amca`. It focuses on namespace consistency, model duplication, upload handling, pivot alignment, controllers, routing/autoload, and general code health.

## High Priority
- [Legacy duplicate models in `app/`] — Resolved 2025-09-01
  - Action taken: Removed legacy duplicates under `app/` after confirming no references remained. Canonical models are under `app/Models/*`.
  - Files removed: `app/Agricultor.php`, `app/AgricultorAnimal.php`, `app/AgricultorFinca.php`, `app/AgricultorPreparado.php`, `app/AgricultorVegetal.php`, `app/Animal.php`, `app/Finca.php`, `app/Preparado.php`, `app/Vegetal.php`.

- [Incorrect namespace in API AgricultorController] — Resolved 2025-09-01
  - Update: `use App\Models\Agricultor;` is now used in `app/Http/Controllers/Api/AgricultorController.php`.

- [Agricultor API upload lacked directory creation] — Resolved 2025-09-01
  - Update: Both `store()` and `update()` now ensure `public/img/agricultores` exists before moving files.

## Medium Priority
- [Inconsistent upload handling between web and API]
  - Files: `app/Http/Controllers/AnimalesController.php`, `AgricultoresController.php` use `$_FILES` and `move_uploaded_file`; API controllers use `Request::file()` and `Validator`.
  - Action: Consider standardizing to Laravel’s `Request` + validation in web controllers for maintainability and security.

- [Model property name differences]
  - Example: `Api\AnimalController` maps request `observacion` to model `observaciones`.
  - Action: Keep mapping documented or align form fields and DB columns to reduce confusion.

- [Old Postman collections may be outdated]
  - Files: `docs/AMCA_Backend.postman_collection.json`, `docs/AMCA_REST.postman_collection.json`.
  - Action: Regenerate/update examples to match current routes, request fields, and image keys (`imagen`).

## Low Priority
- [General validation coverage]
  - Web controllers lack explicit validation; API controllers have good coverage.
  - Action: Add form request validation or inline validation in web controllers.

- [Consistent directory structure documentation]
  - Ensure `tasks.md` reflects actual structure and deprecates legacy `app/*` models.

## Already Fixed (recent)
- PSR-4 Auth controllers corrected and moved to `app/Http/Controllers/Auth/`.
- Replaced `RouteServiceProvider::HOME` with `'/home'`.
- `RegisterController` updated to use `App\Models\User`.
- Legacy `app/User.php` removed; `config/auth.php` uses `App\Models\User`.
- Image uploads standardized to use `public_path()` and directory creation (animals, vegetales, preparados, fincas).
- Pivot models aligned with migrations:
  - `AgricultorAnimal` → `agricultores_animales` (`id_agricultor`, `id_animal`).
  - `AgricultorFinca` → `agricultores_fincas` (`id_agricultor`, `id_finca`).
  - `AgricultorVegetal` → `agricultores_vegetales` (`id_agricultor`, `id_vegetal`).
  - `AgricultorPreparado` → `agricultores_preparados` (`id_agricultor`, `id_preparado`).
- `PaginaController` logic corrected for preparados and pivot operations.
- Autoload (`composer dump-autoload -o`) and routes (`php artisan route:list`) verified clean.

## Specific File Observations
- `app/Http/Controllers/Api/AnimalController.php`
  - Good: Validation, `public_path('img/animales')`, mkdir, `<id>_<original>` filename.
- `app/Http/Controllers/Api/VegetalController.php`
  - Good: Validation, `public_path('img/vegetales')`, mkdir, `<id>_<original>` filename.
- `app/Http/Controllers/Api/PreparadoController.php`
  - Good: Validation, `public_path('img/preparados')`, mkdir, `<id>_<original>` filename.
- `app/Http/Controllers/Api/FincaController.php`
  - Good: Validation, `public_path('img/finca')`, mkdir, `<id>_<original>` filename.
- `app/Http/Controllers/Api/AgricultorController.php`
  - Good: Uses `App\Models\Agricultor` and ensures `img/agricultores` directory exists in `store()` and `update()`.
- `app/Http/Controllers/AnimalesController.php` and `AgricultoresController.php`
  - Use `$_FILES` + `move_uploaded_file` with mkdir; consider switching to `Request::file` and Validator.

## Recommendations
1. Unify upload handling in web controllers using Laravel’s Request + validation for consistency.
2. Run end-to-end upload tests (API and UI) and attach evidence to `docs/`.
3. Update Postman collections to the current endpoints and payloads.
4. Add feature tests for image uploads and pivot attach/detach operations to prevent regressions.

## Quick Patches Proposed
- In `app/Http/Controllers/Api/AgricultorController.php`:
```php
use App\Models\Agricultor; // replace App\Agricultor

$destDir = public_path('img/agricultores');
if (!is_dir($destDir)) { @mkdir($destDir, 0755, true); }
$file->move($destDir, $name);
```

## Appendix: Route and Autoload Status
- `composer dump-autoload -o`: OK (via MAMP PHP; CLI `php` not available globally).
- `php artisan route:list -n`: 72 routes, including Auth and API endpoints, no errors.

