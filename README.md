# PatternPro

**PatternPro** is the ultimate Laravel package designed for developers who prioritize precision, scalability, and maintainability. Built on the foundations of the module, repository, and service patterns, PatternPro helps you structure your application with clean, modular, and efficient code. Ideal for both new projects and existing codebases, this package ensures that your development process follows industry-leading best practices while remaining adaptable to complex business needs.

## Features

- **Modular Structure**: Easily organize your code into modules for better maintainability.
- **Repository Pattern**: Implement data access layers efficiently, promoting a clean separation of concerns.
- **Service Pattern**: Encapsulate business logic and keep your controllers slim and focused.

## Installation

You can install PatternPro via Composer:

```bash
composer require urimz/pattern-pro
```

## Adding CommandServiceProvider to Laravel

To use the `Urimz\PatternPro` package's commands, you need to register its service provider in your Laravel application. This can be done by adding the `CommandServiceProvider` to the provider list.

### Step 1: Register the Service Provider

In your `config/app.php` file, locate the `providers` array and add the following line:

```php
'providers' => [
    // Other Service Providers...

    Urimz\PatternPro\Providers\CommandServiceProvider::class,
],
```
### Step 2: Publish the Provider (Optional)
If the package includes configuration or other assets, you can publish them by running:

```bash
php artisan vendor:publish --provider="Urimz\PatternPro\Providers\CommandServiceProvider"
```

## Publishing Configuration Files

To customize the configuration for this package, you can publish the default configuration files to your project's `config/` directory.

### Steps to Publish the Config

Run the following Artisan command:

```bash
php artisan vendor:publish --tag=config
```
This will publish the package's configuration file, allowing you to modify it according to your project's needs. Once published, you can find the configuration file in the config/ directory of your Laravel project.

## Creating a Module with Necessary Files
PatternPro simplifies module creation by generating all the necessary files, including the model, repository, and service. To create a module, use the following Artisan command:

```
php artisan make:module-model {moduleName} {modelName}
```

This command will automatically generate a new module along with its associated model, controller, requests, resource, policy, repository, repository interface , and service files, allowing you to focus on writing business logic without worrying about the setup.

### Example Usage
```
php artisan make:module-model UserManagement User
```

This will create a UserManagement module with a User model and the corresponding files.

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Author
- urimzymberi - urimzymberii@gmail.com