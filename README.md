#Pizza store

##Description

This test assignment uses Laravel, mysql and jquery.

The pizza store contains multiple product categories (each has its own page)

On the main page there are popular products

Each product has price, description, some images

There is a possibility to place an order for unregistered user

The delivery price and session variables can be set at .env file

Fields at checkout can be added without modifying database structure. `order_properties` table contains those fields.

Also currencies selector available

##Install

1. create mysql database
2. copy .env.example to .env
3. add database settings
4. composer install
5. npm install
6. npm run prod
7. php artisan migrate
8. php artisan db:seed
 
