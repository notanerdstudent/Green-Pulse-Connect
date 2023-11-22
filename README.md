# Green Pulse Connect

Welcome to GreenPulseConnect, your digital gateway to a greener, cleaner tomorrow. As a platform dedicated to sustainability, GreenPulseConnect is your go-to hub for connecting with like-minded individuals, staying informed on the latest green innovations, and actively participating in the global movement towards a more eco-conscious lifestyle.

Explore a world of sustainable living through our diverse categories, from practical Green Living Tips to in-depth discussions on Renewable Energy and Technology. Immerse yourself in the art of Zero Waste Living, discover and review Eco-Friendly Products, and engage in impactful conversations about Climate Action and Advocacy.

GreenPulseConnect isn't just a website; it's a vibrant community where ideas flourish, and actions speak louder than words. Join us on this journey of shared knowledge, inspiration, and collective empowerment as we pulse towards a sustainable, interconnected future. Together, let's amplify the heartbeat of positive change. Welcome to GreenPulseConnect!

## Installation Guide

### Prerequisites

Before you begin, ensure you have the following prerequisites installed on your machine:

-   [PHP](https://www.php.net/manual/en/install.php) (>= 8.1.0)
-   [Composer](https://getcomposer.org/download/)
-   [MySQL](https://dev.mysql.com/downloads/mysql/) or any other database of your choice

### Installation Steps

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/notanerdstudent/Green-Pulse-Connect.git
    ```

2.  **Navigate to the project folder:**

    ```bash
    cd Green-Pulse-Connect
    ```

3.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

4.  **Create a copy of the .env.example file and rename it to .env. Update the database configuration:**

    ```bash
    cp .env.example .env
    ```

    Update the .env file with your database credentials:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database
        DB_USERNAME=your_username
        DB_PASSWORD=your_password

    Update the .env file with your mail settings:

        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="hello@example.com"
        MAIL_FROM_NAME="${APP_NAME}"
    

6.  **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

7.  **Run the database migrations and seed data:**

    ```bash
    php artisan migrate --seed
    ```

8.  **Start the development server:**

    ```bash
    php artisan serve
    ```

## License

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This project is licensed under the MIT License - see the [MIT License](https://choosealicense.com/licenses/mit/) file for details.
