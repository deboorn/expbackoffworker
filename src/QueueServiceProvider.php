<?php namespace ExpBackoffWorker;

use Illuminate\Queue\QueueServiceProvider as IlluminateQueueServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;

class QueueServiceProvider extends IlluminateQueueServiceProvider
{
    /**
     * Register the queue worker.
     *
     * @return void
     */
    protected function registerWorker()
    {
        $this->app->singleton('queue.worker', function () {
            return new Worker(
                $this->app['queue'], $this->app['events'], $this->app[ExceptionHandler::class]
            );
        });
    }
}