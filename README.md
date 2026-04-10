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

## Production Deployment

This is the definitive workflow to turn your manual deployment into a streamlined, scriptable process for your Arch Linux setup.

### Initial Production Setup (One-Time)

Before using the automated scripts, the following must be configured in the GoDaddy cPanel:

1.  **Database Creation:** Use the *MySQL Database Wizard* to create a database and a user. Grant **ALL PRIVILEGES**.
2.  **Domain Mapping (Symlink):** SSH into the server and run the following (also handled by `bin/remote-setup.sh`):
    ```bash
    mv public_html public_html_backup
    ln -s /home/apa780681/hailerz/public /home/apa780681/public_html
    ln -sf /home/apa780681/hailerz/public /home/apa780681/public_html/tiwa_link
    ```
3.  **Environment Setup:** Create `/home/apa780681/hailerz/.env` manually and add:
    * `APP_ENV=production`, `APP_DEBUG=false`.
    * MySQL credentials created in step 1.
    * `ADMIN_EMAIL` and `ADMIN_PASSWORD` for the initial seeder.
4.  **PHP Version Check:** Ensure the CLI version matches your local machine (e.g., PHP 8.3+). If it fails, use the "Platform Spoof" in `composer.json`.

---

## Production Deployment Workflow

### Standard Update (Automated)
To push new features or bug fixes from your local machine, run:
```bash
chmod +x bin/deploy.sh
./bin/deploy.sh
```

### Manual First-Time Deployment
If the script is not used, follow these manual steps:
1.  **Compile & Clean:** `npm run build` and `composer install --no-dev`.
2.  **Zip Payload:** `zip -r hailerz.zip . -x "node_modules/*" -x ".git/*" -x ".env"`.
3.  **Upload & Extract:** `scp` the zip to the server and `unzip` it inside the `hailerz` directory.
4.  **Initialize App:**
    ```bash
    php artisan key:generate
    php artisan migrate --force --seed
    php artisan storage:link
    php artisan optimize
    ```

---

## Environment Management
The `.env` file is **never** uploaded via script to prevent overwriting production secrets with local settings.

* **To update Production ENV:** SSH into the server and use `nano .env`.
* **After any .env change:** Always run `php artisan config:clear` followed by `php artisan optimize`.

---

## Final Housekeeping
Don't forget the **Cron Job** in cPanel. Without it, your internal Filament notifications and scheduled tasks won't fire:
* **Command:** `/usr/local/bin/php /home/apa780681/hailerz/artisan schedule:run >> /dev/null 2>&1`
* **Interval:** Every Minute (`* * * * *`)
