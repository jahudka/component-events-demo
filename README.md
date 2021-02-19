# Component Events Demo

This project showcases the [`jahudka/component-events`] Composer package
on a simple Nette project. It shows one of the typical use-cases
the package was made to solve. The project uses the [Karl eCommerce
HTML5 template] (CC-BY-3.0).

## Requirements
 - PHP 8.0 with `ext-json`, `ext-pdo` and `ext-pdo_pgsql`
 - An empty PostgreSQL 12 database

## Installation

1. Clone the project and checkout the first commit.
2. Copy `etc/config.local.dist` to `etc/config.local.neon`; open the copied
   file in an editor and specify your database connection options.
3. Import the `db-structure.sql` file into the database using whichever
   PostgresSQL client interface you prefer.
4. Run `composer install`.
5. Run `php -S localhost:8000` from within the `public` directory.

## Usage

The project is organised into three Git commits. Each time you check out
a commit you should run `composer install` and if `package.json` is present,
also `npm ci` and `node_modules/bin/gulp`.

1. The base project - a very crude implementation of a cart screen
   as it might look in a typical eshop. You should start by familiarising
   yourself with the project structure.
2. AJAX added to handle cart content manipulation - this commit shows
   the pitfalls of a naive AJAX implementation - the main cart listing
   is updated with the AJAX requests, but the cart widget at the top right
   of the page is not, and neither is the cart total at the bottom right.
3. AJAX fixed by leveraging `jahudka/component-events` - this is where
   ComponentEvents come into play to enable the individual components to
   react to each other without explicitly coupling them.

[`jahudka/component-events`]: https://github.com/jahudka/component-events
[Karl eCommerce HTML5 template]: https://themewagon.com/themes/free-html5-responsive-ecommerce-template/
