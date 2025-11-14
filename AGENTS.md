# AGENTS.md

## Build/Lint/Test Commands
- **Build**: `npm run build`
- **Dev server**: `composer run dev` (runs server, queue, logs, and Vite concurrently)
- **Test all**: `composer run test` or `php artisan test`
- **Test single**: `php artisan test --filter=TestClass::testMethod` or `vendor/bin/phpunit --filter=TestClass::testMethod`
- **Format code**: `vendor/bin/pint`
- **Setup**: `composer run setup` (installs deps, generates key, migrates DB, builds assets)

## Code Style Guidelines
- **PHP**: PSR-4 autoloading, 4-space indentation, UTF-8 encoding, LF line endings
- **Imports**: Group use statements alphabetically, one per line
- **Types**: Use type hints and return types (PHP 8.2+)
- **DocBlocks**: Required for class properties and public methods
- **Naming**: PascalCase for classes, camelCase for methods/properties, snake_case for DB columns
- **Error handling**: Use Laravel's exception handling, throw specific exceptions
- **Testing**: PHPUnit with separate Unit/Feature suites, extend TestCase
- **Formatting**: Laravel Pint for consistent PHP code style