# NT208 Project

Developed by team 1-nt208 under the subject project e-commerce and application deployment.
## Team
###Front-End team :
+ Nguyen Tran Thien An
+ Nguyen Cong Hien
+ Truong Minh Duc
###Back-End team :
+ Truong Minh Duc


## Getting Started
### Installing

To get started, clone project from github

```
git clone https://github.com/ductruong57/nt208.git
```

Switch to the repo folder

```
cd nt208
```

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
php artisan serve
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


