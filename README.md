##Status
It works, but there are still rough spots, most notably navigation and security issues.  It should run on a local server fine, but it's not ready for production yet.

##To install
1. copy files to your web server
2. create a database in mySQL (use "tinyCMS" to match config.php)
3. set up a user with permissions to this database
4. add a config.php file to the root directory with the correct database settings defined
5. visit /setup/install.php and fill out the form.
6. the first user registered is the site administrator and gets to edit anything, don't delete this one! (Or if you do, you can insert a new user manually with a userID of 1)
7. you are redirected to a login page, login
8. from here you can add pages or edit your front page
9. additional users can be added using the register link
10.

###Example config.php
```php
//Database connection settings
define("DB_SERVER", "localhost");
define("DB_USER", "tinyCMS");
define("DB_PASS", "tinycms123");
define("DB_NAME", "tinyCMS");
```
