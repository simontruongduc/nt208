# Config Amazon linux server 

## Getting Started
### Installing PHP
Update package
```
sudo yum update 
```
Confirm that the amazon-linux-extras package is installed:
```
which amazon-linux-extras
```
Output is 
```
/usr/bin/amazon-linux-extras
```
If the command doesn’t return any output, then install the package that will configure the repository
```
sudo yum install -y amazon-linux-extras
```
Enable PHP version want install

```
sudo amazon-linux-extras enable php7.4
```

Now install PHP packages from the repository.

```
sudo yum clean metadata
sudo yum install php php-{pear,cgi,common,curl,mbstring,gd,mysqlnd,gettext,bcmath,json,xml,fpm,intl,zip,imap}
```
Accept installation of PHP 7 packages on Amazon Linux 2.
Check PHP version
```
php -v
```
### Installing PHP
Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate an app encryption key
```
php artisan key:generate
```
Run the database migrations (**Set the database connection in .env before migrating**)
**Make sure you set the correct database connection information before running the migrations**
 ```
 php artisan migrate
 ```   

Start the local development server
```
php artisan server
```
##Database seeding

create client for passport
```
php artisan passport:install
``` 
Import data using sql code in 3 file province.sql, districts.sql and ward.sql in repo folder storage/sql

Run the database seeder and you're done
```
php artisan db:seed
``` 

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command
```
php artisan migrate:refresh
```

If You want to clean the database and seeding
```
php artisan migrate:refresh --seed
```


