# ecomApp

## Features

- Admin authentication 
- Product CRUD 
- User authentication
- Product  listing
- Add to cart and remove from cart functionality  


# Installation

### =>clone this repo and install composer and setup env
```bash
composer install
php artisan key:generate
```
 
### =>Install Breeze Authentication
```bash
php artisan breeze:install
```
    
### =>Migrate Database
```bash
php artisan migrate
```
  
### =>Install node module  and setup assets
```bash
npm install
npm run dev
```

### =>Serve the project on localhost
```bash
php artisan serve
```
    