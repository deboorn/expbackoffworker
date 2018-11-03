<?php namespace ExpBackoffWorker;

class GetDelay
{
    private $maxDelay;
    private $defaultDelay;

    /**
     * GetDelay constructor
     *
     * @param  int  $maxDelay      Maximum delay for a job (default 7200)
     * @param  int  $defaultDelay  Default initial job delay
     */
    public function __construct($maxDelay = 7200, $defaultDelay = 30)
    {
        $this->maxDelay = $maxDelay;
        $this->defaultDelay = $defaultDelay;
    }

    /**
     * Add exponential delay based on the job attempts and the provided delay seconds.
     * The delay will default to 30 seconds by default or when delay is set to zero.
     * A max delay of 2 hours will be used when exponential delay exceeds 2 hours
     * Example of delay in seconds: 30, 60, 120, 240, ... 7200
     *
     * @param  int  $workerDelay    The delay from the WorkerOptions object
     * @param  int  $attemptsCount  How many attempts there have been so far on the job
     * @return int
     */
    public function __invoke($workerDelay, $attemptsCount)
    {
        $delay = $workerDelay ?: $this->defaultDelay;
        if ($attemptsCount > 1) {
            // 2^(attempts-2) * delay
            $delay = 2 ** ($attemptsCount - 2) * $delay;
        } else {
            // First attempt always gets a delay of 0
            $delay = 0;
        }
        return min($delay, $this->maxDelay);
    }
}
