# AGENTS.md

## Build/Lint/Test Commands
- **Build frontend**: `npm run build`
- **Dev server**: `composer run dev` (runs Laravel server, queue, logs, and Vite concurrently)
- **Test all**: `composer run test` or `php artisan test`
- **Test single**: `php artisan test --filter=TestClass::testMethod` or `./vendor/bin/pest --filter=TestClass::testMethod`
- **Format code**: `vendor/bin/pint`
- **Setup**: `composer run setup` (installs deps, generates key, migrates DB, builds assets)

## Code Style Guidelines
- **PHP**: PSR-4 autoloading, 4-space indentation, UTF-8 encoding, LF line endings
- **Imports**: Group use statements alphabetically, one per line
- **Types**: Use type hints and return types (PHP 8.2+), union types where appropriate, readonly properties where applicable
- **DocBlocks**: Required for class properties and public methods, use @var for properties
- **Naming**: PascalCase for classes, camelCase for methods/properties, snake_case for DB columns
- **Error handling**: Use Laravel's exception handling, throw specific exceptions with context
- **Testing**: Pest framework with separate Unit/Feature suites, extend Tests\TestCase with RefreshDatabase trait
- **Formatting**: Laravel Pint for PHP, EditorConfig for consistency (4 spaces, LF endings)
- **Frontend**: Alpine.js, Vite for bundling, ES modules, Blade Lucide Icons