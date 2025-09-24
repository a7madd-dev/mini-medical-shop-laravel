# Mini Medical Shop

A Laravel-based e-commerce web application for managing and purchasing medical products.  
This project demonstrates **role-based access control, product management, order processing, stock validation, and activity logging**.

---

## Features

### Customer Side (Public)
- Browse products (name, image, description, price).
- Search, sort, and filter products by category.
- Add to Cart (with stock validation).
- Manage cart (update quantity, remove items).
- Checkout without login (collects name, phone, and address).
- Order confirmation page after successful checkout.
- Prevent overselling (stock validation at checkout).

### Admin Side (Protected via Laravel Breeze)
- **Dashboard** with quick stats (Products, Orders, Logs).
- Manage products (CRUD).
- Manage orders (view, track).
- Product activity logs (created, updated, deleted).
- Categories managed via dropdown (with option to add new).
- Role-based access: Only admins can access `/dashboard`.

### Core Requirements Met
- Laravel Breeze for auth.
- MySQL database only.
- Blade templating (no SPA).
- Clean modular structure (Controllers, Models, Observers).
- Validation + user-friendly error messages.
- Seeders + Factories for test data.
- Clear documentation for developers.

---

## Tech Stack
- **Backend**: Laravel 12
- **Frontend**: Blade + Tailwind CSS
- **Database**: MySQL
- **Auth**: Laravel Breeze
- **Session**: Cart stored in Laravel Session
- **Logging**: ProductObserver → ProductLogs

---

## Setup Steps

### 1. Clone the Repository
```bash
git clone https://github.com/a7madd-dev/mini-medical-shop-laravel.git
cd mini-medical-shop
```

### 2. Install Dependencies
```bash
composer install
npm install && npm run build
```

### 3. Configure Environment
Copy `.env`:
```bash
cp .env.example .env
```
Update DB credentials for MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=medical_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations + Seeders
```bash
php artisan migrate:fresh --seed
```

### 5. Start the Server
```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## Test Login Credentials

### Admin
- **Email**: `a7madd5111@gmail.com`
- **Password**: `6600`

### Customer
- Register via `/register`.

---

## Seeders & Factories
- `AdminSeeder` → seeds a default admin.
- `ProductFactory` → generates 4 sample products.

---

## Project Structure

```
app/
 ├── Http/Controllers/   # Controllers
 ├── Models/             # Models (Product, Order, Logs)
 ├── Observers/          # ProductObserver for activity logging
database/
 ├── factories/          # Model factories
 ├── seeders/            # Seeders (AdminSeeder, ProductSeeder, etc.)
resources/views/
 ├── layouts/            # Layout + Navigation
 ├── profile/            # Profile views
 ├── products/           # Product CRUD views
 ├── orders/             # Orders views
 ├── logs/               # Activity logs
 ├── cart/               # Cart views
 ├── checkout/           # Checkout views
```

---

## Developer Notes
- **Role-based auth**: Middleware restricts `/dashboard` and admin routes.
- **Activity Logs**: Automatically generated on product create/update/delete.
- **Stock Validation**: At checkout, adjusts to available stock or blocks order.
- **SEO**: Basic meta tags + semantic HTML added.
- **Accessibility**: Labels added for forms, buttons, and selects.

---

## Contributing
- Fork the repo.
- Create a feature branch.
- Submit a pull request.

---

## License
This project is created by [Ahmad Sami Yousef](https://a7madd.com)