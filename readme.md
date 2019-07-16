# Pause-able Queue worker for Laravel 5.x

This package provides a way to implement a pause function into the queue, 
for a more automated way to pause queue workers.

The way this works is to only fetch a new job if the queue is not paused.

## Installation

`composer require centagon/laravel-pauseable-queue`


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