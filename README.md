# eCommerce API

## Overview

This is a RESTful API for an eCommerce platform. The API is built with Laravel and provides functionality for product management, user authentication, cart operations, and order processing. The frontend interacts with this API to provide a seamless shopping experience.

## Features

- **User Authentication**: Sign up, log in, and manage user sessions.
- **Product Management**: View products, filter by category, and retrieve product details.
- **Cart Operations**: Add items to the cart, update quantities, and remove items.
- **Order Processing**: Place orders and view order history.

## Requirements

- PHP 8.0 or higher
- Composer
- MySQL
- Laravel 10.x

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/yourusername/ecommerce-api.git
   cd ecommerce-api
   ```
2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Configure Environment**

Copy the example environment file and configure your database settings:

  ```bash
   cp .env.example .env
   ```

  ```bash
   php artisan key:generate
   ```

4. **Migrate Database**

   ```bash
   php artisan migrate
   ```

5. **Seed Database**

   ```bash
   php artisan db:seed
   ```

6. **Run Server**

   ```bash
   php artisan serve
   ```

7. **Open Browser**

   ```bash
   open http://localhost:8000
   ```
