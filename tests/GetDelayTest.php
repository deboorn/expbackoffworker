<?php namespace ExpBackoffWorker;

use PHPUnit\Framework\TestCase;
use ExpBackoffWorker\GetDelay;

class GetDelayTest extends TestCase
{
    public function testExponentialBackoffDefaults()
    {
        $maxDelay = 7200;
        $getDelay = new GetDelay;

        $delays = [0, 30, 60, 120, 240, 480, 960, 1920, 3840, $maxDelay, $maxDelay];

        foreach ($delays as $attempt => $expectedDelay) {
            $delay = $getDelay(0, ++$attempt);
            $this->assertEquals($expectedDelay, $delay, "Attempt $attempt");
        }
    }

    public function testExponentialBackoffCustomMaxdelay()
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

    public function testExponentialBackoffCustomWorkerdelay()
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
