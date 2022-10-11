
# A package to get basic account info for a Twitter account without requiring a Twitter API login.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paulhennell/twitter-account-info.svg?style=flat-square)](https://packagist.org/packages/paulhennell/twitter-account-info)
[![Tests](https://github.com/paulhennell/twitter-account-info/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/paulhennell/twitter-account-info/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/paulhennell/twitter-account-info.svg?style=flat-square)](https://packagist.org/packages/paulhennell/twitter-account-info)

This is a basic package to get the number of followers an account has on Twitter without the complications of the official Twitter API. As a non-official project however it should be considered possible to stop working at any time. 

## Installation

You can install the package via composer:

```bash
composer require paulhennell/twitter-account-info
```

You may require a Http Client library if you don't have one in your project. [See here for more](https://docs.php-http.org/en/latest/httplug/users.html).

For a fast fix you can simply install guzzle first like so:

```bash
composer require guzzlehttp/psr7
```

## Usage

You can use the system by account name or by Twitter ID. A recommended workflow is
to use the name first to acquire the ID, then store the ID for repeat checking.

```php
$accountInfo = (new Paulhennell\TwitterAccountInfo())->getFromUsername("hennell_dev");
echo $accountInfo->followers_count;

$accountInfo = (new Paulhennell\TwitterAccountInfo())->getFromId("1261694242067447808");
echo $accountInfo->formatted_followers_count;
```

If your HTTP Client isn't automatically discovered you can pass it into the constructor:

```php
$accountInfo = (new Paulhennell\TwitterAccountInfo($httpClient))->getFromUsername("hennell_dev");
```


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Credits

- [Paul Hennell](https://github.com/paulhennell)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
