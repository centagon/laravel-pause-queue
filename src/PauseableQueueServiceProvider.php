<?php

namespace Centagon\PauseableQueue;

use Centagon\PauseableQueue\Commands\PauseCommand;
use Centagon\PauseableQueue\PauseableWorker;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Queue\QueueServiceProvider;
use Illuminate\Console\Application as Artisan;

class PauseableQueueServiceProvider extends QueueServiceProvider {

    public function register()
    {
        parent::register();
        $this->registerPauseCommand();
    }
    
    /**
     * Register the queue worker.
     *
     * @return void
     */
    protected function registerWorker()
    {
        $this->app->singleton('queue.worker', function () {
            return new PauseableWorker(
                    $this->app['queue'], $this->app['events'], $this->app[ExceptionHandler::class]
            );
        });
    }
    
    protected function registerPauseCommand()
    {
        if ( $this->app->runningInConsole() ) {
            $command= PauseCommand::class;
            
            Artisan::starting(function ($artisan) use ($command) {
                $artisan->resolve($command);
            });
        }
    }

}
