REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Git Clone

Clone this repo (example used is `C:\xampp\htdocs`)
```
cd C:\xampp\htdocs
git clone https://github.com/mr-jp/yii-avalon.git
```

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
php composer.phar install
~~~

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=avalon',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

**NOTES:**
- The schema for the database is `schema.sql`

### Setup Virtual Host

1. Edit `httpd-vhosts.conf` located under `C:\xampp\apache\conf\extra` and add this
```
<VirtualHost avalon>
    ServerAdmin webmaster@avalon
    DocumentRoot "C:/xampp/htdocs/yii-avalon/web"
    ServerName avalon
    ServerAlias avalon
    ErrorLog "logs/dummy-host2.avalon-error.log"
    CustomLog "logs/dummy-host2.avalon-access.log" common
</VirtualHost>
```
2. Edit `hosts` file under `C:\Windows\System32\drivers\etc` and add this line:
```
127.0.0.1 avalon
```
3. Restart your apache server
4. You should see the frontpage on `http://avalon`
5. You can login to admin using `http://avalon/index.php?r=site%2Flogin`
```
username: admin
password: avalon123
```