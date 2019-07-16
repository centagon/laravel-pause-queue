# Pause-able Queue worker for Laravel 5.x

This package provides a way to implement a pause function into the queue, 
for a more automated way to pause queue workers.

The way this works is to only fetch a new job if the queue is not paused.

## Installation

As per today, we did not yet add the repository to packagist, you can add our cvs by adding it to the composer repositories:

```
"repositories": [
        { "type": "git", "url": "https://github.com/centagon/laravel-pauseable-queue", "reference":"dev" }
    ],
```

The add our package:

```
composer require centagon/laravel-pauseable-queue:^1.0.1
```


In your `config/app.php`

Change: the `Illuminate\Queue\QueueServiceProvider::class` to `Centagon\PauseableQueue\PauseableQueueServiceProvider::class`


```php
'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        ...
//        Illuminate\Queue\QueueServiceProvider::class,
        Centagon\PauseableQueue\PauseableQueueServiceProvider::class,
        ...
        Illuminate\View\ViewServiceProvider::class,
        ...

],
```

After this, make sure you issue the queue restart command:

`php artisan queue:restart`


## Commands


### Pausing the queue

`php artisan queue:pause`


### Un-pausing the queue

`php artisan queue:pause --unpause`



## Programmatically checking the paused status

`$paused = cache()->has("illuminate:queue:pause");`


Thats it, enjoy your new pause-able queue