<?php namespace ExpBackoffWorker;

use Illuminate\Queue\QueueServiceProvider as IlluminateQueueServiceProvider;

class QueueServiceProvider extends IlluminateQueueServiceProvider {

	protected function registerWorker()
	{
		$this->registerWorkCommand();

		$this->registerRestartCommand();

		$this->app->singleton('queue.worker', function($app)
		{
			return new Worker($app['queue'], $app['queue.failer'], $app['events']);
		});
	}


}
