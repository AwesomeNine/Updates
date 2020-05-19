# Updates

[![Awesome9](https://img.shields.io/badge/Awesome-9-brightgreen)](https://awesome9.co)
[![Latest Stable Version](https://poser.pugx.org/awesome9/updates/v/stable)](https://packagist.org/packages/awesome9/updates)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/awesome9/updates.svg)](https://packagist.org/packages/awesome9/updates)
[![Total Downloads](https://poser.pugx.org/awesome9/updates/downloads)](https://packagist.org/packages/awesome9/updates)
[![License](https://poser.pugx.org/awesome9/updates/license)](https://packagist.org/packages/awesome9/updates)

<p align="center">
	<img src="https://img.icons8.com/nolan/256/approve-and-update.png"/>
</p>

## 📃 About Updates

This package provides ease of running update routines within a plugin.

## 💾 Installation

``` bash
composer require awesome9/updates
```

## 🕹 Usage

First, you need to spin out configuratio for your updates.

```php
Awesome9\Updates\Updates::get()
	->set_folder( dirname( __FILE__ ) . '/updates' ) // Directory where you store your update routine files.
	->set_version( '1.0.0' )                         // Your plugin version.
	->set_option_name( 'awesome9_plugin_version' );  // Option name to store version number in database.
```

Now, let's add some updates routines we want to run.

```php
Awesome9\Updates\Updates::get()
	->add_updates(
		array(
			'1.1.0' => 'update-1.1.0.php',
			'1.1.1' => 'update-1.1.1.php',
		)
	);
```

Let's assume your plugin tree looks like this:

```
my-plugin/
└── updates/
   ├── update-1.1.0.php
   └── update-1.1.1.php
```

The update file could look like this:

```php
<?php
/**
 * Update routine
 *
 * @since 1.1.0
 */

/**
 * Update new roles and capabilities
 *
 * @since 1.1.0
 *
 * @return void
 */
function awesome9_update_1_1_0_remove_role() {
	remove_role( 'awesome9_manager' );
	remove_role( 'awesome9_employee' );
}

awesome9_update_1_1_0_remove_role();

```

## 📖 Changelog

[See the changelog file](./CHANGELOG.md)
