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
     * @param  \Exception  $e
     * @return void
     *
     * @throws \Exception
     */
    protected function handleJobException($connectionName, $job, WorkerOptions $options, $e)
    {
        $options->delay = (new GetDelay)($options->delay, $job->attempts());

        parent::handleJobException($connectionName, $job, $options, $e);
    }
}
