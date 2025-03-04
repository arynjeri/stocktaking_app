# Stocktaking App

A web application for managing inventory and stock levels.

## Description

This application allows users to track their inventory, add new items, update stock levels, and view reports. It's designed for small businesses or individuals who need a straightforward way to manage their stock.

## Features

* **Item Management:** Add, edit, and delete inventory items.
* **Stock Tracking:** Update stock levels for each item.
* **Reporting:** View basic reports on current stock levels.
* **User Authentication:** Secure login for authorized users.
* **Database Storage:** Items are stored in a MySQL database.
* **Category Management:** Organize items into customizable categories.
* **Low Stock Alerts:** Receive notifications when stock levels fall below a specified threshold.
* **Search and Filter:** Quickly find items using search and filter options.

## Installation

To set up and run the Stocktaking App, follow these steps:

1.  **Clone the Repository:**

    * Open your terminal or command prompt.
    * Navigate to the directory where you want to store the project.
    * Run the following command, replacing `[Your Repository URL]` with your repository's URL:

        ```bash
        git clone [Your Repository URL]
        ```

2.  **Database Setup:**

    * **MySQL Database:**
        * Ensure you have MySQL installed and running.
        * Create a new database for your application.
        * Open the `db_connection.php` file in a text editor.
        * Update the database connection details (`hostname`, `username`, `password`, `database name`) to match your MySQL setup.

3.  **Web Server Setup:**

    * **XAMPP/WAMP/MAMP (Local Development):**
        * If you're using a local development environment like XAMPP, WAMP, or MAMP, copy the contents of the cloned repository into your web server's document root (e.g., `htdocs` for XAMPP).
    * **Web Server (Production):**
        * If deploying to a web server, upload the repository's files to your web server's document root or a designated folder.
        * Ensure your web server has PHP and MySQL support enabled.

4.  **Laravel Setup:**

    * If you have not already, install composer.
    * From the root directory of the project, run `composer install`.
    * Copy the `.env.example` file to `.env`.
    * Run `php artisan key:generate`.
    * Update the `.env` file with the database credentials.
    * Run `php artisan migrate`.

5.  **Access the Application:**

    * **Local Development:**
        * Open your web browser and navigate to `http://localhost/stocktaking-app/public`.
    * **Production Server:**
        * Open your web browser and navigate to your application's URL.

## Technologies

* PHP (Laravel Framework)
* MySQL
* HTML
* CSS
* JavaScript

## Contributing

1.  Fork the repository.
2.  Create a new branch for your feature or bug fix.
3.  Make your changes and commit them.
4.  Push your changes to your fork.
5.  Submit a pull request.

## Contact

arymburu@gmail.com
