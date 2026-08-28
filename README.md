# Alam Buttons - Enterprise Laravel Corporate Website

## Setup Instructions

### Prerequisites
- PHP 8.2+
- Composer
- Node.js (for frontend assets)
- MySQL or SQLite

### Installation

1. **Install Dependencies**
```bash
composer install
npm install
```

2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database Setup**
For SQLite (default):
```bash
php artisan migrate
php artisan db:seed
```

For MySQL:
- Create database `alam_buttons`
- Update `.env` with MySQL credentials
```bash
php artisan migrate
php artisan db:seed
```

4. **Build Assets**
```bash
npm run build
```

5. **Start Server**
```bash
php artisan serve
```

### Default Credentials
- Email: admin@alam.com
- Password: password

### Features

#### Frontend
- Home page with hero slider, concerns preview, featured products, latest jobs
- About module (Mission, History, Board of Directors, Contact)
- Concerns listing with dynamic dropdown in navbar
- Product portfolio with filters (concern, category)
- Product details with variants (size, color) and image gallery
- Showroom listing with contact info and map
- Career page with job listings and application form
- Mobile-first responsive design

#### Admin Panel
- Dashboard with statistics and recent applications
- Full CRUD for Concerns, Products, Product Variants, Product Images
- Job and Application management
- Showroom management
- About content (Directors, History, Pages)
- Media gallery (slider images)

#### Technical
- Laravel 12 with Blade templates
- Tailwind CSS (mobile-first)
- Alpine.js for interactivity
- Laravel Breeze authentication
- Spatie Permission (roles & permissions)
- Fully dynamic (no hardcoded content)
- SEO-friendly URLs

### Project Structure
```
app/
  Http/
    Controllers/
      Admin/       # Admin controllers
      Frontend/    # Public controllers
    Requests/     # Form requests
  Models/        # Eloquent models

database/
  migrations/   # Database migrations
  seeders/      # Demo data

resources/
  views/
    admin/       # Admin templates
    frontend/    # Public templates
    layouts/     # Master layouts
```

### License
MIT License