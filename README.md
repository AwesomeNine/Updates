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

This  .
This package provides ease of running update routines within a WordPress plugin. It provides methods to check the current installed version of the plugin, determine which updates need to be applied, and apply those updates in order.


## 💾 Installation

``` bash
composer require awesome9/updates
```

## 🕹 Usage

First, you need to create a concrete class that extends `Updates`.

You will need to create a new class that extends the `Updates` class and implements the abstract methods.

```php
use Awesome9\Updates\Updates;

class MyPluginUpdates extends Updates {

    public function get_updates(): array {
        return [
            '1.0.1' => '/updates/update-1.0.1.php',
            '1.0.2' => '/updates/update-1.0.2.php',
        ];
    }

    public function get_folder(): string {
        return plugin_dir_path( __FILE__ ) . 'updates/';
    }

    public function get_version(): string {
        return '1.0.2'; // Replace with your plugin's current version
    }

    public function get_option_name(): string {
        return 'awesome9_plugin_version'; // Option name to store the version in the database
    }
}
```

Now, in your plugin's main file, initialize the updates manager and bind the hooks:

```php
$my_plugin_updates = new MyPluginUpdates();
$my_plugin_updates->hooks();
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
