# HRIS API Application Setup and Module Generation Guide

## Introduction

This guide provides step-by-step instructions for setting up a Laravel application and using a custom artisan command (`php artisan make:module`) to generate new modules.

## Prerequisites

Before you begin, ensure you have the following installed on your system:

-   PHP (>= 8.1)
-   Composer
-   MySQL or other supported databases

## Setting Up a Laravel Application

1.  **Clone the repository:**

    ```bash
    git clone https://github.com/your-repo/your-laravel-project.git
    cd your-laravel-project
    ```

2.  **Install dependencies:**
        ```bash
        composer install
        ```
3.  **Environment setup:**

    - Copy the `.env.example` file to `.env` and update the database credentials.
    - Generate a new application key:

        ```bash
        php artisan key:generate
        ```

4.  **Run the migrations and seed the database:**

    ```bash
    php artisan migrate --seed
    ```

5.  **Run the application:**

    ```bash
    php artisan serve
    ```

6.  **Access the application:**

        Open your browser and navigate to `http://localhost:8000`.

## Custom Artisan Command: `make:module`

The `make:module` command generates a new module with the following structure:

```
app/
├── Modules/
│   └── ExampleModule/
│       ├── app/
│       ├── config/
│       ├── database/
│       ├── routes/
│       ├── tests/
│       ├── composer.json/
│       ├── module.json/
|       └── package.json/
```

To generate a new module, run the following command:

```bash
php artisan make:module ExampleModule
```

This will create a new module named `ExampleModule` in the `Modules` directory.

## Conclusion

This guide provides a step-by-step process for setting up the HRIS application and generating new modules using a custom artisan command. By following these instructions, you can quickly create a new module and customize it to suit your needs.
