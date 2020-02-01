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

First of all, add a SHERLOCK_SCORE_API_KEY key to your .env file:
```
SHERLOCK_SCORE_API_KEY=a12b34c56...
```

You can also disable this package by adding a SHERLOCK_SCORE_ENABLED key set to false (true by default).

To start interacting with Sherlock Score, use the following methods:

```
use SherLaravel;
```

```
SherLaravel::identifyAccount("groupIdHere");
```
With Sherlock you can keep track of Accounts (or groups of users). To identfy a new account, add the line above to your controller.

```
SherLaravel::identifyUser("userIdHere");
```
The identifyUser method is used to identify a new User. It will be tipically added to the register method on your login controller, or in the "created" event of your User Model in case you are using Observers.

```
SherLaravel::trackEvent("userID", "event-name");
```
On your controllers, use the trackEvent method every time you want to track an interaction with a user.


```
public function identifyAccount(String $group_id, ?Array $traits= [], ?int $timestamp = null)
public function identifyUser(String $user_id, ?String $group_id = null, ?Array $traits= [], ?int $timestamp = null)
public function trackEvent(String $user_id, String $event, ?int $timestamp = null)
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
