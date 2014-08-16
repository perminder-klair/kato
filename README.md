# Kato CMS

[ ![Codeship Status for perminder-klair/kato](https://codeship.io/projects/27e66250-f320-0131-9544-4a285323a758/status)](https://codeship.io/projects/27806)

Thank you for choosing Kato - a PHP CMS based on Yii2 Framework.

To get started, check out [http://getkato.com](http://getkato.com)!

## Documentation
Read the [Documentation](docs/index.md) for information like installation, usage, examples and more.

## Admin Access
Login to Admin Panel by visiting: www.yoursite.com/admin

## REST API Demo
By visiting: www.yoursite.com/api/demos

## DIRECTORY STRUCTURE

```
api
	config/				contains shared configurations
	controllers/		contains API controller classes
	runtime/			contains files generated during runtime
	web/				contains the entry API resources
common
	config/				contains shared configurations
	mail/				contains view files for e-mails
	models/				contains model classes used in both backend and frontend
	tests/				contains various tests for objects that are common among applications
console
	config/				contains console configurations
	controllers/		contains console controllers (commands)
	migrations/			contains database migrations
	models/				contains console-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the console application
backend
	assets/				contains application assets such as JavaScript and CSS
	config/				contains backend configurations
	controllers/		contains Web controller classes
	models/				contains backend-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the backend application
	views/				contains view files for the Web application
	web/				contains the entry script and Web resources
frontend
	assets/				contains application assets such as JavaScript and CSS
	config/				contains frontend configurations
	controllers/		contains Web controller classes
	models/				contains frontend-specific model classes
	runtime/			contains files generated during runtime
	tests/				contains various tests for the frontend application
	views/				contains view files for the Web application
vendor/					contains dependent 3rd-party packages
environments/			contains environment-based overrides
```

## Requirements
The minimum requirement is that your Web server supports PHP 5.4 and Yii2 Framework.

## Bug tracker and feature requests
If you find any bugs or have a feature request?, please create an issue at [issue tracker for project Github repository](https://github.com/perminder-klair/kato/issues).

## Known Issues
Visit [Security page](docs/security.md) for more information.

## License
This work is licensed under a MIT license. Full text is included in the `LICENSE` file in the root of codebase.

## Authors
**Parminder Klair**

+ [http://twitter.com/pinku1](http://twitter.com/pinku1)
+ [https://github.com/perminder-klair](https://github.com/perminder-klair)
