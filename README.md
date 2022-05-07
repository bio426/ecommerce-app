# Ecommerce App

A simple `ecommerce` application, with functionalities to create vendors, products and orders.

## Table of Contents

-   [E-commerce App](#ecommerce-app)
    -   [Table of Contents](#table-of-contents)
    -   [Motivation](#motivation)
    -   [Technologies](#technologies)
    -   [Screenshots](#screenshots)
    -   [Installation](#installation)
    -   [References](#references)

## Motivation

This project was made to `improve my knowledge` of the Laravel framework. Understand how it works with the MVC pattern as well as the structure of routes and controllers, the use of Sanctum for authentication, the way Eloquent works and how models and `table structures` are related. And the integration of `javascript libraries` in Blade views.

## Requeriments

The main requirements that the application should achieve.

- Create and authenticate a User.
- User can create Product.
- User can delete Product.
- User can create an Order that includes Products.
- User can't include is own Products in Order.
- On Product delete, Orders that include the Product should be marked as canceled.
- User can view the Orders that include his Products.
- User can deliver the Orders that include his Products.
- When an Order has all its related Products delivered, should be marked as completed.


## Technologies

Some of the technologies that were used for building this project.

-   [Laravel](https://www.typescriptlang.org/)
-   [Tailwind](https://vuejs.org/)
-   [Php](https://v3.nuxtjs.org/)
-   [SqLite](https://sass-lang.com/)

<div style="display:flex;justify-content:center;gap:16px">
  <img src="./docs/laravel-ico.svg" alt="laravel icon" width="50" height="50">
  <img src="./docs/tailwind-ico.svg" alt="tailwind icon" width="50" height="50">
  <img src="./docs/php-ico.svg" alt="php icon" width="50" height="50"/>
  <img src="./docs/sqlite-ico.svg" alt="sqlite icon" width="50" height="50"/>
</div>

## Screenshots

Some of the main views of the project.

<div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem">

![screenshot](/docs/index.png "index view")

![screenshot](/docs/dashboard.png "dashboard view")

![screenshot](/docs/cart.png "cart view")

![screenshot](/docs/products.png "products view")

![screenshot](/docs/orders.png "orders view")

</div>

## Installation

`Composer`,`PHP` and `NPM` is required to run this project.

```bash
# Install dependencies
$ composer install
$ npm install
# Run database migrations
$ php artisan migrate
# Build frontend assets
$ npm run dev
# start application server
$ php artisan serve
```

For more details, you can check [Laravel Docs](https://laravel.com/docs/9.x)

## References

The documentastion sites and other resources that help with the project.

-   [Laravel Docs](https://laravel.com/docs/9.x)
