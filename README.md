# Track user activities in Laravel 5 applications
This package will track created, updated or deleted event on subscribed models and will store useful info about it.

## Features
- Composer installable
- PSR4 auto loading
- Track created, updated or deleted event on subscribed models
- Write logs in database or log files
- Command for cleaning logs

## Requires
Build only for Laravel Framework 5 only!

## Installation
In terminal
```sh
composer require aginev/activity-log:1.0.*
```

Add Service Provider to your config/app.php like so
```php
// config/app.php

'providers' => [
    '...',
    Aginev\ActivityLog\ActivityLogServiceProvider::class,
];
```

Publish migrations
```sh
php artisan vendor:publish --provider="Aginev\ActivityLog\ActivityLogServiceProvider" --tag="migrations"
php artisan migrate
```

Publish config
```sh
php artisan vendor:publish --provider="Aginev\ActivityLog\ActivityLogServiceProvider" --tag="config"
```

Optionally you can add activity log command and you will be able to clean your logs.
```php
// app/Console/Kernel.php

protected $commands = [
    '...',
    \Aginev\ActivityLog\Commands\ActivityLogClean::class,
];
```

## Usage

Get activities
```php
$logs = \ActivityLog::getActivities()->get(); // Get all activities
$logs = \ActivityLog::getLatestActivities(2); // Get latest 2 activities
```

Clean log
```php
$logs = \ActivityLog::cleanLog(30); // Offset in days
```

Clean the log from terminal
```sh
php artisan activity-log:clean
```

## Custom handler implmentations
1. Implement \Aginev\ActivityLog\HandlersLogActivityInterface\ActivityLogInterface in your custom handler. 
2. Place custom handler as value in activity-log.log config

## Credits
https://github.com/spatie/activitylog - Similar package but with different implementation. Code blocks used from there. Thanks!

## License
MIT - http://opensource.org/licenses/MIT
