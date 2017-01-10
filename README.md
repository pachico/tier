# Pachico\Tier

![Travis](https://travis-ci.org/pachico/tier.svg?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pachico/tier/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pachico/tier/?branch=master) [![codecov](https://codecov.io/gh/pachico/tier/branch/master/graph/badge.svg)](https://codecov.io/gh/pachico/tier)

Tier is a simple class with no dependencies that handles the definition of application tiers.
This is to avoid the usage of non standard strings that usually define the tier an application is running in.

This becomes handly when dealing with frameworks and the required tier configuration files.

## Install

Via Composer

``` bash
$ composer require pachico/tier
```

## Usage

```php
use Pachico\Tier\Tier;
$tier = new Tier(Tier::DEVELOPMENT, [
    Tier::DEVELOPMENT,
    Tier::STAGING,
    Tier::PRODUCTION
    ]
);
echo $tier . PHP_EOL; // development
echo json_encode($tier, JSON_PRETTY_PRINT) . PHP_EOL;
/**
{
    "tier": "development",
    "applicationTiers": [
        "development",
        "staging",
        "production"
    ]
}
*/

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email pachicodev@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
