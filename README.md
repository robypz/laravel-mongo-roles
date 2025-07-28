# Laravel MongoDB Roles & Permissions

## Logo (150px)
<p align="center">
  <img src="/art/remove%20the%20checkmark.png" alt="Logo" width="150"/>
</p>

**Simple roles and permissions for Laravel using MongoDB.**

---

## Características

- Middleware para roles y permisos.
- Directivas Blade para roles y permisos.
- Integración con [mongodb/laravel-mongodb](https://github.com/mongodb/laravel-mongodb).
- Migraciones y seeders listos para usar.
- Fácil de extender y personalizar.

---

## Instalación

1. **Instala el paquete vía Composer:**

   ```bash
   composer require robypz/laravel-mongo-roles
   ```

2. **Publica y ejecuta las migraciones:**

   ```bash
   php artisan vendor:publish --provider="RobYpz\MongoRole\Providers\MongoRoleServiceProvider" --tag=migrations
   php artisan migrate
   ```

3. **Agrega el ServiceProvider si es necesario:**

   En `config/app.php`:

   ```php
   'providers' => [
       // ...
       RobYpz\MongoRole\Providers\MongoRoleServiceProvider::class,
   ],
   ```

---

## Uso

### Seeders

Ejemplo de seeder para crear usuarios, roles y permisos:

```php
use RobYpz\MongoRole\Models\Role;
use RobYpz\MongoRole\Models\Permission;
use Workbench\Database\Factories\UserFactory;

$user = UserFactory::new()->create([
    'name' => 'Test User',
    'email' => 'test@example.com',
]);

$role = Role::create(['name'=> 'role']);
$permission = Permission::create(['name'=> 'permission']);

$role->permissions()->attach($permission);
$user->roles()->attach($role);
```

### Middleware

Protege tus rutas usando los middlewares:

```php
Route::get('/hasRole', function () {
    return response(null,200);
})->middleware(['auth','role:role']);

Route::get('/hasPermission', function () {
    return response(null,200);
})->middleware(['auth','permission:permission']);

Route::get('/hasAnyRole', function () {
    return response(null,200);
})->middleware(['auth','any_role:role,anotherRole']);

Route::get('/hasAnyPermission', function () {
    return response(null,200);
})->middleware(['auth','any_permission:permission,anotherPermission']);
```

### Directivas Blade

```blade
@role('role')
    Bienvenido usuario con rol
@endrole

@permission('permission')
    Bienvenido usuario con permiso
@endpermission

@any_role('role,anotherRole')
    Bienvenido usuario con alguno de los roles
@endany_role

@any_permission('permission,anotherPermission')
    Bienvenido usuario con alguno de los permisos
@endany_permission
```

---

## Testing

Incluye pruebas con [Pest](https://pestphp.com/) y [Orchestra Testbench](https://github.com/orchestral/testbench):

```bash
composer test
```

---

## Configuración

Puedes personalizar la configuración en [`src/config/mongorole.php`](src/config/mongorole.php).

---

## Licencia

MIT © [Robert Yepez](mailto:robertyepez0208@hotmail.com)

---

## Logo (150px)

<p align="center">
  <img src="/art/remove%20the%20checkmark.png" alt="Logo" width="150"/>
</p>

---

## Estructura del paquete

- `src/` Código fuente principal.
- `workbench/` Entorno de pruebas y desarrollo.
- `tests/` Pruebas unitarias y funcionales.
- `art/` Recursos gráficos (logo).

---

¿Preguntas o sugerencias? ¡Abre un issue