README for https://github.com/gabrielfonsecasousa/cuco_health_back

POSTMAN DOCUMENTATION: https://documenter.getpostman.com/view/13857857/2s93JoxR6V

This is a backend project for managing customers in a healthcare context. It was written in Laravel and uses a MySQL database.
Features

The project includes the following features:

    A Customer model with attributes such as name, email, and phone number.
    A CustomerController with methods for index, store, show, update, and destroy.
    Request validation for customer creation and update.
    Unit tests for the CustomerController methods.
    Translated to Brazilian Portuguese.

Installation

To use this project, first clone the repository:

bash

git clone https://github.com/gabrielfonsecasousa/cuco_health_back.git

Then, install the required dependencies using composer:

composer install

Copy the example environment file to create a new .env file:

bash

cp .env.example .env

Generate an application key:

vbnet

php artisan key:generate

Create a new MySQL database for the project and add the database details to the .env file.

Run the database migrations:

php artisan migrate

Start the development server:

php artisan serve

Usage

The API has the following endpoints:

    GET /api/customers - Returns a list of all customers.
    POST /api/customers - Creates a new customer.
    GET /api/customers/{id} - Returns the details of a specific customer.
    PUT /api/customers/{id} - Updates the details of a specific customer.
    DELETE /api/customers/{id} - Deletes a specific customer.

To create or update a customer, send a JSON payload in the request body with the customer details.
Testing

To run the unit tests, use the following command:

bash

php artisan test

Contributing

Contributions to this project are welcome. If you find a bug or would like to suggest a new feature, please create an issue in the GitHub repository.
