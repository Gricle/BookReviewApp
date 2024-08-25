# BookReview Laravel App

Welcome to the BookReview Laravel App! This application allows users to authenticate, review books, rate them, and interact with publishers and authors. Below is a comprehensive guide to help you understand the features, installation, and usage of the app.

## Table of Contents

1. [Features](#features)
2. [Installation](#installation)
3. [Usage](#usage)
4. [Models](#models)
5. [Contributing](#contributing)
6. [License](#license)

## Features

- **User Authentication**: Secure login and registration for users.
- **Book Reviews**: Users can write and submit reviews for books.
- **Book Ratings**: Rate books on a scale of 1 to 5 stars.
- **Follow System**: Follow authors and publishers to receive updates.
- **Publisher Model**: Manage publishers and their associated books.
- **Reviewer Model**: Track users who review books.
- **Author Model**: Manage authors and their works.

## Installation

To set up the BookReview Laravel App on your local machine, follow these steps:

### Prerequisites

- PHP >= 8.2
- Composer
- Laravel >= 11.9x
- MySQL or another database

### Steps

1. Clone the Repository:
   - git clone https://github.com/gricle/bookreview-laravel.git
   - cd bookreview-laravel

2. Install Dependencies:
   - composer install

3. Set Up Environment:
   - Copy the .env.example file to .env:
   - cp .env.example .env

4. Configure Database:
   - Update your .env file with your database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=yourdatabase
     DB_USERNAME=yourusername
     DB_PASSWORD=yourpassword
     ```

5. Generate Application Key:
   - php artisan key:generate

6. Run Migrations:
   - php artisan migrate

7. Start the Development Server:
   - php artisan serve

Now, you can access the application at http://localhost:8000.

