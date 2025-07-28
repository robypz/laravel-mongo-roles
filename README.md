# Laravel MongoDB Roles & Permissions

## Logo
<p align="center">
  <img src="/art/remove%20the%20checkmark.png" alt="Logo" width="150"/>
</p>

**Simple roles and permissions for Laravel using MongoDB.**

---

## Features

- Middleware for roles and permissions.
- Blade directives for roles and permissions.
- Integration with [mongodb/laravel-mongodb](https://github.com/mongodb/laravel-mongodb).
- Ready-to-use migrations and seeders.
- Easy to extend and customize.

---

## Installation

1. **Install the package via Composer:**

   ```bash
   composer require robypz/laravel-mongo-roles
   ```

2. **Publish and run the migrations:**

   ```bash
   php artisan vendor:publish --provider="RobYpz\MongoRole\Providers\MongoRoleServiceProvider" --tag=migrations
   php artisan migrate
   ```

3. **Add the ServiceProvider if necessary:**

   In `config/app.php`:

   ```php
   'providers' => [
       // ...
       RobYpz\MongoRole\Providers\MongoRoleServiceProvider::class,
   ],
   ```

---

## Usage

### Seeders

Example seeder to create users, roles, and permissions:

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

Protect your routes using the middlewares:

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

Route::get('/PermissionTo', function () {
    return response(null,200);
})->middleware(['auth','permission_to:permission']);

Route::get('/hasAnyPermissionTo', function () {
    return response(null,200);
})->middleware(['auth','any_permission_to:permission,anotherPermission']);
```

### Blade Directives

```blade
@role('role')
    Welcome user with role
@endrole

@permission('permission')
    Welcome user with permission
@endpermission

@any_role('role,anotherRole')
    Welcome user with any of the roles
@endany_role

@any_permission('permission,anotherPermission')
    Welcome user with any of the permissions
@endany_permission

@permission_to('permission,anotherPermission')
    Welcome user with any of the permissions
@endpermission_to

@any_permission_to('permission,anotherPermission')
    Welcome user with any of the permissions
@end_any_permission_to



```

---

## Testing

Includes tests with [Pest](https://pestphp.com/) and [Orchestra Testbench](https://github.com/orchestral/testbench):

```bash
composer test
```

---

## Configuration

You can customize the configuration in [`src/config/mongorole.php`](src/config/mongorole.php).

---

## License

MIT © [Robert Yepez](mailto:robertyepez0208@hotmail.com)

---

## Logo

<p align="center">
  <img src="/art/remove%20the%20checkmark.png" alt="Logo" width="150"/>
</p>

---

## Package Structure

- `src/` Main source code.
- `workbench/` Development and testing environment.
- `tests/` Unit and functional tests.
- `art/` Graphic resources (logo).

---

## Traits: HasMongoRoles & HasMongoPermissions

### HasMongoRoles

Add the `HasMongoRoles` trait to your User model to enable role and permission management via MongoDB.

#### Methods

- **roles()**  
  Returns the roles related to the user.

- **hasRole(string|array $roles): bool**  
  Returns `true` if the user has all the specified roles.

- **hasAnyRole(string|array $roles): bool**  
  Returns `true` if the user has at least one of the specified roles.

- **hasPermission(string|array $permissions): bool**  
  Returns `true` if the user has all the specified permissions through their roles.

- **hasAnyPermission(string|array $permissions): bool**  
  Returns `true` if the user has at least one of the specified permissions through their roles.

### HasMongoPermissions

> This trait provides an alternative approach: assign permissions directly to users, without roles.  
> **Note:** `HasMongoPermissions` is already included in `HasMongoRoles`, so you do not need to add both.

#### Methods

- **permissions()**  
  Returns the permissions related to the user.

- **hasPermissionTo(string|array $permissions): bool**  
  Returns `true` if the user has all the specified direct permissions.

- **hasAnyPermissionTo(string|array $permissions): bool**  
  Returns `true` if the user has at least one of the specified direct permissions.

---

Add the trait to your User model:

```php
use RobYpz\MongoRole\Traits\HasMongoRoles;

class User extends Authenticatable
{
    use HasMongoRoles; // Includes HasMongoPermissions
    // ...
```

---

Questions or suggestions? Open an issue or contact me directly.