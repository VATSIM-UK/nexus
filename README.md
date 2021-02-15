# Nexus
This project uses [Tailwind](https://www.tailwindcss.com), [Alpine.js](https://www.github.com/alpinejs/alpine/), [Laravel](https://www.laravel.com) and [Livewire](https://www.laravel-livewire.com).

## Installation
### Cloning This Repository
Clone this repository to your local machine and enter the directory that is created.
```git
git clone git@github.com:VATSIM-UK/nexus.git vatsim-uk-nexus
cd vatsim-uk-nexus
```

### Setting Up Laravel
Generally, this project will follow the [standard installation instructions](https://www.laravel.com/docs/installation) relating to Laravel. The following is an abbreviated guide to get started quickly.

Install the Composer dependencies and create an environment file by copying the example (`.env.example`).
```bash
composer install
cp .env.example .env
```

Generate an application key.
```bash
php artisan key:generate
```

### Compiling Frontend Assets
Install all required dependencies.
```bash
yarn
```
Compile the assets.
```bash
yarn dev
```

### Serve The Application
Laravel ships with a handy way to serve the application on a PHP development server.
To start, simply run the below command.
```bash
php artisan serve
```
