Wordpress-Airbrake
==================

A Wordpress plugin to connect to the [Airbrake](http://www.airbrake.io) service.

Makes use of [PHP-Airbrake](http://github.com/nodrew/php-airbrake) library.


Installation
============

Install as a typical Wordpress plugin by cloning the repo into `wp-content/plugins/wordpress-airbrake`.

Then, login to the Wordpress admin backend and visit the **Airbrake** menu in **Settings**.

Provide the Airbrake API Key, and Enable the plugin.


Notes
=====

- This has been tested and working using Wordpress 3.4, running on the Heroku Cedar stack.
- [PHP-Airbrake](http://github.com/nodrew/php-airbrake) supports using [PHP-Resque](https://github.com/chrisboulton/php-resque) to send exceptions via Resque, but this is not (yet) supported in the Wordpress plugin. If you need support for Resque, I'm happy to look over pull requests.
