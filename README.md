# Hailerz Entertainment Platform

A full-stack talent booking and agency management platform. This application serves as both the public-facing talent discovery engine and the internal CRM for managing artists, inbound leads, and event production resources.

The architecture is explicitly designed to provide a modern, reactive single-page-application (SPA) experience while remaining compatible with traditional shared hosting environments without requiring a Node.js server runtime.

---

## Technical Stack

*   Framework: Laravel 13
*   Admin CRM: Filament v5
*   Public Storefront: Livewire v4 (Anonymous/Volt-style Components)
*   Styling: Tailwind CSS (compiled via Vite)
*   Database: SQLite (Local Development) / MySQL (Production)

---

## Core Features

### The Admin Back-Office (Filament)
*   Talent Roster Management: Full CRUD interface for artists, including media uploads (headshots, PDF riders), dynamic pricing, and target market tagging.
*   Booking Pipeline: Centralized dashboard to track inbound event requests from Lead to Confirmed.
*   Submission Queue: Review portal for prospective artists applying to join the agency.
*   Resource CMS: Lightweight content manager for publishing industry guides and downloadable assets.

### The Public Storefront (Livewire)
*   Dynamic Discovery Grid: Real-time, reactive filtering of the talent roster by category.
*   Multi-Step Booking Engine: Frictionless data capture for event inquiries.
*   Artist Submission Portal: Front-end application workflow for prospective talent.
*   SEO Optimized: Server-side rendered by default for perfect indexing.

---

## Local Development Setup

Follow these steps to set up the project on a new installation:

1.  Clone and Install Dependencies
    ```bash
    git clone <repository-url>
    cd hailerz-php
    composer install
    npm install
    ```

2.  Configure the Environment
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Add your administrative credentials to the bottom of the `.env` file:
    ```env
    ADMIN_NAME="Hailerz Admin"
    ADMIN_EMAIL="admin@hailerz.com"
    ADMIN_PASSWORD="SuperSecretPassword123!"
    ```

3.  Build and Seed the Database
    The application uses SQLite for development. This command will run migrations and seed the database with 50 objects for every table using the JSON files in `database/data/`.
    ```bash
    touch database/database.sqlite
    php artisan migrate:fresh --seed
    ```
    *Note: The seeder handles the creation of the Admin user based on your `.env` variables.*

4.  Configure Storage
    ```bash
    php artisan storage:link
    ```

5.  Boot the Servers
    ```bash
    # Terminal 1: Backend
    php artisan serve

    # Terminal 2: Frontend
    npm run dev
    ```

---

## Common Development Tasks

### 1. Database Seeding & Data Management
Raw data is stored as JSON in `database/data/`.
*   To update seed data, edit the JSON files and run:
    `php artisan db:seed`
*   In production (e.g., GoDaddy), if `.env` changes aren't reflecting, run:
    `php artisan config:clear`

### 2. Database Migrations
*   Create a new migration:
    `php artisan make:migration create_tableName_table`
*   Apply changes:
    `php artisan migrate`

### 3. Creating a Filament Resource (Admin)
*   Generate: `php artisan make:filament-resource ModelName`
*   Move the generated class into a subfolder within `app/Filament/Resources/` to maintain organization.

### 4. Public Livewire Components
*   Create: `php artisan make:livewire ComponentName`
*   Components are saved in `resources/views/livewire/` as single-file anonymous components.

---

## Production Deployment (GoDaddy/Shared Hosting)

1. Upload the project files.
2. Point your domain to the `public/` directory.
3. Update `.env` with production MySQL credentials and Admin settings.
4. Run `npm run build` locally and upload the `public/build` directory.
5. Run migrations and seeder on the server:
   ```bash
   php artisan migrate --force
   php artisan db:seed
   ```
