## Lazychef

[![Latest Stable Version](https://poser.pugx.org/lazychef/core/version.png)](https://packagist.org/packages/lazychef/core) [![Total Downloads](https://poser.pugx.org/lazychef/core/d/total.png)](https://packagist.org/packages/lazychef/core)

Lazychef is designed to be a very minimal blogging platform with the primary focus on writing. Currently it is a work in progress but you are free to give it a try. (Just be warned this alpha/beta quality). If you have any issues or ideas please report them.

![Lazychef](http://lazychefcms.com/media/lazychef-air-large.png)


Installing Lazychef As A Project
---------------------------------------

Creating a stand-alone Lazychef installation is now as simple as running `composer create-project lazychef/lazychef`. For more information [lazychefcms.com](visit http://lazychefcms.com).

Installing Lazychef In An Existing Laravel Application
---------------------------------------

Installing Lazychef in an existing Laravel application couldn't be easier!
If you have the [Laravel Package Installer](https://github.com/rtablada/package-installer), simply run `php artisan package:install lazychef/core`.

If you do not have  `'lazychef/core': '0.3.*'` to your `composer.json` file and run `composer update`.
Then add `Lazychef\Core\LazychefServiceProvider` to your providers and `'Lazychef' => 'Lazychef\Core\Facades\LazychefFacade'` to your aliases in `app/config/app.php`.

Now the last thing you need to do is publish the necessary files configuration and theme files by running `php artisan lazychef:config`, `php artisan config:publish lazychef/core`, and `php artisan lazychef:themes`.

Configuring the Database Connection
---------------------------------------

LazychefCMS is designed to give you maximum database configuration within existing Laravel applications.
If you would like to use the default database connection from your host app, no configuration is necessary.
However, if you would like to use a separate database connection, this is available in the `app/config/package/lazychef/core/database.php` file.

If the `default` configuration is set to `default` it will use the host application connection. Otherwise, it will use the connection details listed in this `connection` array.

Finally, to migrate to your selected database connection run `php artisan lazychef:migrate`.

Creating Your First User
---------------------------------------

If you are using Lazychef as a package, you will have to create a user.
This is as easy as running `php artisan lazychef:user:create first_name last_name email password`, of course filling in your own details as the arguments.

Using Lazychef
---------------------------------------

By default, your LazychefCMS blog will be located in your applications index.
The administration panel will be located at `/lazychef`.

Both of these routes can be configured using route group rules from the `app/config/package/lazychef/core/routes.php` file.

Theming Lazychef
---------------------------------------
By default, your theme files are located in `public/themes`.
You can modify these themes or create your own using the default themes as a guide.
The configuration for your themes is located in `app/config/packages/lazychef/core/lazychef.php` in the `theme` option.