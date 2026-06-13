# Retail Shop Inventory System

Laravel 12 inventory system for a small retail shop with barcode-driven product lookup, purchases, sales, stock takes, suppliers, audit trail, reports, Bootstrap 5 UI, and MySQL schema.

## Stack

- Laravel 12
- MySQL
- Bootstrap 5
- USB/Bluetooth barcode scanner support through normal keyboard input
- Maatwebsite Excel for product import/export

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Set your MySQL credentials in `.env`.

## Barcode Scanners

Most USB/Bluetooth scanners work as keyboard input. Put the cursor in any barcode field, scan, and the app searches products by barcode automatically.
