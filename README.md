# 🍰 DeliciosBalance

App to track your spendings. 

## Installation

```
git clone https://github.com/ossipov/balance.git
cd balance
composer install
cp .env.example .env
php artisan key:generate
touch database\database.sqlite
php artisan migrate:fresh
php artisan db:seed
php artisan serve 

```
