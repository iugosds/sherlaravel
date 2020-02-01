# SherLaravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]w
[![Build Status][ico-travis]][link-travis]

Sherlock Score integration for Laravel.

Track your users, trials, and paid accounts with Sherlock’s Product Engagement Scoring engine.

## Installation

Via Composer

``` bash
$ composer require iugosds/sherlaravel
```

## Usage

```
use SherLaravel;
```

```
SherLaravel::identifyAccount("groupIdHere");
SherLaravel::identifyUser("userIdHere");
SherLaravel::trackEvent("userID", "event-name");
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Credits

- [Gonzalo Medeiros][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/iugosds/sherlaravel.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/iugosds/sherlaravel.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/iugosds/sherlaravel/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/iugosds/sherlaravel
[link-downloads]: https://packagist.org/packages/iugosds/sherlaravel
[link-travis]: https://travis-ci.org/iugosds/sherlaravel
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/iugosds
[link-contributors]: ../../contributors
