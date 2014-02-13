# Ansible Installer

This is originally taken form the [composer/installers](https://github.com/composer/installers) and
adapted to work as an [ansible](http://www.ansible.com/home) role installer.

[![Build Status](https://secure.travis-ci.org/monofone/installers.png)](http://travis-ci.org/monofone/installers)

This is for PHP package authors to require in their `composer.json`. It will
install their package to the correct location based on the specified package
type.

The goal of `installers` is to be a simple package type to install path map.
Users can also customize the install path per package and package authors can
modify the package name upon installing.


**Current Supported Package Types**:

> Stable types are marked as **bold**, this means that installation paths
> for those type will not be changed. Any adjustment for those types would
> require creation of brand new type that will cover required changes.

| Framework    | Types
| ---------    | -----
| ansible      | `ansible-role`


## Example `composer.json` File

This is an example for a ansible role. The only important parts to set in your
composer.json file are `"type": "ansible-role"` which describes what your
package is and `"require": { "ansible/installer": "~1.0" }` which tells composer
to load the custom installers.

```json
{
    "name": "you/mysql",
    "type": "ansible-role",
    "require": {
        "ansible/installer": "~1.0"
    }
}
```

This would install your role to the `provisioning/roles/common/` folder when a
user runs `php composer.phar install`.

## Custom Install Paths

If you are consuming a package that uses the `ansible/installer` you can
override the install path with the following extra in your `composer.json`:

```json
{
    "extra": {
        "installer-paths": {
            "your/custom/path/{$name}/": ["ansible/web", "vendor/package"]
        }
    }
}
```

A package type can have a custom installation path with a `type:` prefix.

``` json
{
    "extra": {
        "installer-paths": {
            "your/custom/path/{$name}/": ["type:ansible-role"]
        }
    }
}
```

This would use your custom path for each of the listed packages. The available
variables to use in your paths are: `{$name}`, `{$vendor}`, `{$type}`.

## Custom Install Names

If you're a package author and need your package to be named differently when
installed consider using the `installer-name` extra.

For example you have a package named `you/mysql` with the type
`ansible-role`. Installing with `ansible/installer` would install to the
path `provisioning/roles/mysql`. Due to the strict naming conventions, you as a
package author actually need the package to be named and installed to
`provisioning/roles/ownmysql`. Using the following config within your **package** `composer.json`
will allow this:

```json
{
    "name": "you/mysql",
    "type": "ansible-role",
    "extra": {
        "installer-name": "ownmysql"
    }
}
```

Please note the name entered into `installer-name` will be the final and will
not be inflected.
