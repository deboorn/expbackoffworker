# ExpBackoffWorker


Adds automatic exponential backoff with default delay of 30 seconds and max delay of 2 hours to Laravel 5.3+ queue worker.


How to Install
---------------

### Laravel 5.3+

1.  Install the `deboorn/expbackoffworker` package

    ```shell
    $ composer require deboorn/expbackoffworker
    ```

2. Update `config/app.php` to activate ExpBackoffWorker

    ```php
    # Add `QueueServiceProvider` to the `providers` array
    'providers' => [
        ...
        ExpBackoffWorker\QueueServiceProvider::class,
    ]
    ```
3. Update `config/queue.php` to increase redis.expire to max delay + 100

    ```php
		'redis' => [
		    ...
			'expire' => 7300,
		],
    
    ```
