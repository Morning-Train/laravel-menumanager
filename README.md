# Menu manager for Laravel

[![Software License](https://img.shields.io/badge/licence-%20GNU%20General%20Public%20License%20v3.0-brightgreen.svg)](LICENSE.md)
![](https://img.shields.io/badge/version-1.0.0-brightgreen.svg)

## Install

Via Composer

``` bash

$ composer require morningtrain/menumanager

```

Add this service provider to your config/app.php file.

``` php

morningtrain\menumanager\menumanagerServiceProvider::class,

```



## Usage

``` php

	Menu::addItem('admin', ['routealias' => 'someroute', 'title' => 'Menu item title']);
		
	Menu::addItem('admin', ['as' => 'unique_name', 'routealias' => 'someroute', 'title' => 'Indhold', 'children' => [
		['routealias' => 'someroute', 'title' => 'Menu item 1'],
		['routealias' => 'someroute', 'title' => 'Menu item 2'],
		['routealias' => 'someroute', 'title' => 'Menu item 3'],
		['routealias' => 'someroute', 'title' => 'Menu item 4'],
		['routealias' => 'someroute', 'title' => 'Menu item 5'],
	]]);
	
	Menu::addItem('admin', ['as' => 'unique_name', 'routealias' => 'someroute', 'title' => 'Indhold', 'children' => [
		['routealias' => 'someroute', 'title' => 'Menu item 1'],
		['routealias' => 'someroute', 'title' => 'Menu item 2'],
		['routealias' => 'someroute', 'title' => 'Menu item 3'],
		['routealias' => 'someroute', 'title' => 'Menu item 4'],
		['routealias' => 'someroute', 'title' => 'Menu item 5'],
	]]);

```

``` php

	{!! Menu::get('admin') !!}

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email mail@morningtrain.dk instead of using the issue tracker.

## Credits

- [Morning Train][link-author]

## License

GNU General Public License v3.0. Please see [License File](LICENSE.md) for more information.

[link-packagist]: https://packagist.org/packages/morningtrain/menumanager
[link-author]: https://morningtrain.dk
