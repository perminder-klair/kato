# REQUIREMENTS

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

# Installation

* [Download the latest release](https://github.com/perminder-klair/kato/archive/master.zip).

Get Yii2 Framework and other required components using Composer:

Inside protected directory run:

    php composer.phar install

Grab database from:

    /kato2.sql



## GETTING STARTED

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/params-local.php` accordingly.
3. Apply migrations with console command `yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend `/path/to/kato-application/frontend/web/` and using the URL `http://frontend/`
- for backend `/path/to/kato-application/backend/web/` and using the URL `http://backend/`