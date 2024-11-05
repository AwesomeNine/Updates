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

This package provides ease of running update routines within a WordPress plugin. It provides methods to check the current installed version of the plugin, determine which updates need to be applied, and apply those updates in order.


## 💾 Installation

``` bash
composer require awesome9/updates
```

## 🕹 Usage

### Step 1: Implement the `Updates` Class

To use the package, create a class that extends the `Updates` abstract class. Implement the following methods in your custom class:

- `get_updates()` - Returns an associative array of version numbers and update file paths.
- `get_folder()` - Returns the folder path where update files are stored.
- `get_version()` - Returns the current plugin version.
- `get_option_name()` - Returns the option name used to store the plugin version in the database.

```php
use Awesome9\Updates\Updates;

class MyPluginUpdates extends Updates {

    /**
     * Define update versions and file paths.
     *
     * @return array<string, string>
     */
    public function get_updates(): array {
        return [
            '1.0.1' => 'updates/update-1.0.1.php',
            '1.0.2' => 'updates/update-1.0.2.php',
        ];
    }

    /**
     * Specify the updates folder path.
     *
     * @return string
     */
    public function get_folder(): string {
        return plugin_dir_path( __FILE__ ) . 'updates/';
    }

    /**
     * Get the current plugin version.
     *
     * @return string
     */
    public function get_version(): string {
        return '1.0.2'; // Replace with your plugin's current version
    }

    /**
     * Define the database option name for storing the plugin version.
     *
     * @return string
     */
    public function get_option_name(): string {
        return 'awesome9_plugin_version';
    }
}
```

### Step 2: Initialize and Bind Hooks

In your plugin’s main file, instantiate your `MyPluginUpdates` class and bind the hooks to handle updates automatically:

```php
$my_plugin_updates = new MyPluginUpdates();
$my_plugin_updates->hooks();
```

### Step 3: Structure Your Plugin’s Update Files

Arrange your plugin folder to include separate files for each update version. Your folder structure might look like this:

```
my-plugin/
└── updates/
   ├── update-1.1.0.php
   └── update-1.1.1.php
```

### Step 4: Write Update Files

Each update file should contain code for the specific update, like this example for `update-1.0.1.php`:

```php
<?php
/**
 * Update routine for version 1.0.1
 *
 * @since 1.0.1
 */

/**
 * Example update function to remove obsolete roles.
 *
 * @since 1.0.1
 * @return void
 */
function awesome9_update_1_0_1_remove_roles() {
	remove_role( 'awesome9_manager' );
	remove_role( 'awesome9_employee' );
}

awesome9_update_1_0_1_remove_roles();
```

## 📖 Changelog

[See the changelog file](./CHANGELOG.md)
