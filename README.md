
# A package to get basic account info for a Twitter account without requiring a Twitter API login.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/paulhennell/twitter-account-info.svg?style=flat-square)](https://packagist.org/packages/paulhennell/twitter-account-info)
[![Tests](https://github.com/paulhennell/twitter-account-info/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/paulhennell/twitter-account-info/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/paulhennell/twitter-account-info.svg?style=flat-square)](https://packagist.org/packages/paulhennell/twitter-account-info)

This is a basic package to get the number of followers and other basic account info from Twitter without the complications of the official Twitter API. As a non-official project it should not be considered totally reliable, and as of v1.0 this relies on a Nitter instance, so if they all break, this will too.

# Abandoned
With twitter cracking down on API and scraping systems, the nitter workaround is so unreliable this package has become unusuable.

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

You use the system by passing in a twitter username

```php
$accountInfo = (new Paulhennell\TwitterAccountInfo())->getFromUsername("hennell_dev");
echo $accountInfo->followers_count;
echo $accountInfo->tweet_count; //etc
```

If your HTTP Client isn't automatically discovered you can pass it into the constructor:

```php
$accountInfo = (new Paulhennell\TwitterAccountInfo($httpClient))->getFromUsername("hennell_dev");
```

### Nitter
As of V1.0 this package relies on scraping the alternative twitter front end [Nitter](https://github.com/zedeus/nitter).

Nitter has multiple instances and by default this package will randomly use one of four (see: RandomNitterUrl class).

To specify a specific instance you can pass a url string in with the username:
```php
$accountInfo = (new Paulhennell\TwitterAccountInfo())->getFromUsername("hennell_dev", "https://nitter.net");
```
For more advance use (like random selection, or running an uptime check to pick a currently working nitter site) you can pass in any class that implements `NitterUrlInterface` - which simply needs to return a url string from a static method `getUrl`.

You can find a helpful list of possible nitter instances [here](https://github.com/xnaas/nitter-instances)

## Testing

```bash
composer test
```

For client packages be sure to avoid running tests that would execute a web request. Use Mockery to fake the Twitter AccountInfo class and return a manually created AccountInfo object.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Credits

- [Paul Hennell](https://github.com/paulhennell)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
