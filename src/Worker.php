<?php namespace ExpBackoffWorker;

use Illuminate\Queue\Worker as IlluminateQueueWorker;
use Illuminate\Queue\WorkerOptions;

class Worker extends IlluminateQueueWorker
{
    /**
     * Handle an exception that occurred while the job was running.
     *
     * @param  string  $connectionName
     * @param  \Illuminate\Contracts\Queue\Job  $job
     * @param  \Illuminate\Queue\WorkerOptions  $options
     * @param  \Throwable  $e
     * @return void
     *
     * @throws \Throwable
     */
    protected function handleJobException($connectionName, $job, WorkerOptions $options, $e)
    {
        $options->backoff = (new GetDelay)($options->backoff, $job->attempts());

        parent::handleJobException($connectionName, $job, $options, $e);
    }
}
