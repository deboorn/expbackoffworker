# ExpBackoffWorker


Adds automatic exponential backoff with default delay of 30 seconds and max delay of 2 hours to Laravel 5.0 queue worker. 


How to Install
---------------

### Laravel 5.0

1.  Install the `deboorn/ExpBackoffWorker` package

    ```shell
    $ composer require deboorn/ExpBackoffWorker
    ```

1. Update `config/app.php` to activate ExpBackoffWorker

    ```php
    # Add `QueueServiceProvider` to the `providers` array
    'providers' => array(
        ...
        'ExpBackoffWorker\QueueServiceProvider',
    )

    ```
