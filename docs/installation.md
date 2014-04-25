# REQUIREMENTS

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

# Installation

* [Download the latest release](https://github.com/perminder-klair/kato/archive/master.zip).

Get Yii2 Framework and other required components using Composer.

If you do not have [Composer](https://getcomposer.org), you may install it by following the instructions at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

Inside protected directory run:

    php composer.phar install

Grab database from:

    /kato.sql


## GETTING STARTED

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `./init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/kato-application/frontend/web/` and using the URL `http://site.com/`
- for backend `/path/to/kato-application/backend/web/` and using the URL `http://site.com/admin/`

- Logins for admin:
-- Username: `admin`
-- Password: `admin12`

## Theming

To update assets like css and images: `/frontend/web/`
To change/update layout and views of site: `/frontend/web/themes/basic`