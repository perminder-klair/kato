# REQUIREMENTS

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

# Installation

* [Download the latest release](https://github.com/perminder-klair/kato/archive/master.zip).

Get Yii2 Framework and other required components using Composer.

If you do not have [Composer](https://getcomposer.org), you may install it by following the instructions at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install required libraries using the following command:

    php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta2"
    php composer.phar install


## GETTING STARTED

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `./init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `./yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend the URL will be `http://site.com/`
- for backend the URL will be `http://site.com/admin/`

To login into the application, you need to first sign up, with any of your email address, username and password. Then, you can login into the application with same email address and password at any time.

## Theming

To update assets like css and images: `/frontend/web/`
To change/update layout and views of site: `/frontend/web/themes/basic`
TO change theme: in file `/common/config/bootstrap.php` change var `$frontendTheme`