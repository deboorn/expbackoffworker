<?php namespace ExpBackoffWorker;

use Exception;
use Illuminate\Queue\Worker as IlluminateQueueWorker;
use Illuminate\Contracts\Queue\Job;

class Worker extends IlluminateQueueWorker
{

    public function process($connection, Job $job, $maxTries = 0, $delay = 0)
    {
        if ($maxTries > 0 && $job->attempts() > $maxTries) {
            return $this->logFailedJob($connection, $job);
        }

        try {
            // First we will fire off the job. Once it is done we will see if it will
            // be auto-deleted after processing and if so we will go ahead and run
            // the delete method on the job. Otherwise we will just keep moving.
            $job->fire();

            return ['job' => $job, 'failed' => false];
        } catch (Exception $e) {
            // If we catch an exception, we will attempt to release the job back onto
            // the queue so it is not lost. This will let is be retried at a later
            // time by another listener (or the same one). We will do that here.
            if (!$job->isDeleted()) {

                // Add exponential delay based on the job attempts and the provided delay seconds.
                // The delay will default to 30 seconds by default or when delay is set to zero.
                // A max delay of 2 hours will be used when exponential delay exceeds 2 hours
                // Example of delay in seconds: 30, 60, 90, 180, ... 7200
                $delay = $delay ?: 30;
                $delay = $job->attempts() > 1 ? (pow(2, $job->attempts() - 2) * $delay) : 0;
                $maxDelay = 60 * 60 * 2;
                if ($delay > $maxDelay) $delay = $maxDelay;

                $job->release($delay);
            }

            throw $e;
        }
    }

}
