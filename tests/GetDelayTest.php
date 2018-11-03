<?php

use PHPUnit\Framework\TestCase;
use ExpBackoffWorker\GetDelay;

class GetDelayTest extends TestCase
{
    public function test_exponential_backoff_defaults()
    {
        $maxDelay = 7200;
        $getDelay = new GetDelay;

        $delays = [0, 30, 60, 120, 240, 480, 960, 1920, 3840, $maxDelay, $maxDelay];

        foreach ($delays as $attempt => $expectedDelay) {
            $delay = $getDelay(0, ++$attempt);
            $this->assertEquals($expectedDelay, $delay, "Attempt $attempt");
        }
    }

    public function test_exponential_backoff_custom_maxdelay()
    {
        $maxDelay = 3600;
        $defaultDelay = 15;
        $getDelay = new GetDelay($maxDelay, $defaultDelay);

        $delays = [0, 15, 30, 60, 120, 240, 480, 960, 1920, $maxDelay, $maxDelay];

        foreach ($delays as $attempt => $expectedDelay) {
            $delay = $getDelay(0, ++$attempt);
            $this->assertEquals($expectedDelay, $delay, "Attempt $attempt");
        }
    }

    public function test_exponential_backoff_custom_workerdelay()
    {
        $maxDelay = 3600;
        $defaultDelay = 30;
        $getDelay = new GetDelay($maxDelay, $defaultDelay);

        $delays = [0, 15, 30, 60, 120, 240, 480, 960, 1920, $maxDelay, $maxDelay];

        foreach ($delays as $attempt => $expectedDelay) {
            $delay = $getDelay(15, ++$attempt);
            $this->assertEquals($expectedDelay, $delay, "Attempt $attempt");
        }
    }
}
