# ExpBackoffWorker

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Adds automatic exponential backoff with default delay of 30 seconds and max delay of 2 hours to Laravel 5.3+ queue worker.

## Install

### Laravel 5.3+

1.  Install the `deboorn/expbackoffworker` package via Composer

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

3. Update `config/queue.php` to increase {queue-driver}.retry_after to max delay + 100, such as redis.retry_after

    ```php
        # Update `retry_after` for the queue connection you plan to use
        'redis' => [
              ...
            'retry_after' => 7300,
        ],
    ```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email daniel.boorn [at] gmail.com instead of using the issue tracker.

## Credits

- [Daniel Boorn][link-author]
- [Eric Tendian][link-contributor]
- [All Contributors][link-contributors]

## License

The Apache 2.0 License (Apache-2.0). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/deboorn/expbackoffworker.svg?style=flat-square
[ico-license]: https://img.shields.io/github/license/deboorn/expbackoffworker.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/deboorn/expbackoffworker/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/deboorn/expbackoffworker.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/deboorn/expbackoffworker.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/deboorn/expbackoffworker.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/deboorn/expbackoffworker
[link-travis]: https://travis-ci.org/deboorn/expbackoffworker
[link-scrutinizer]: https://scrutinizer-ci.com/g/deboorn/expbackoffworker/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/deboorn/expbackoffworker
[link-downloads]: https://packagist.org/packages/deboorn/expbackoffworker
[link-author]: https://github.com/deboorn
[link-contributor]: https://github.com/EricTendian
[link-contributors]: ../../contributors
