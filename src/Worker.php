<?php namespace ExpBackoffWorker;

use Exception;
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
        // Add exponential delay based on the job attempts and the provided delay seconds.
        // The delay will default to 30 seconds by default or when delay is set to zero.
        // A max delay of 2 hours will be used when exponential delay exceeds 2 hours
        // Example of delay in seconds: 30, 60, 90, 180, ... 7200
        $options->delay = $options->delay ?: 30;
        $options->delay = $job->attempts() > 1 ? (pow(2, $job->attempts() - 2) * $options->delay) : 0;
        $maxDelay = 60 * 60 * 2;
        if ($options->delay > $maxDelay) $options->delay = $maxDelay;

        parent::handleJobException($connectionName, $job, $options, $e);
    }
}
