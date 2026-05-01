# Hailerz Entertainment Platform

A full-stack talent booking and agency management platform built on Laravel 13. The application serves two distinct purposes: a public-facing talent discovery storefront and an internal CRM for managing artists, inbound booking inquiries, talent submissions, editorial content, and email communications.

The architecture is designed to deliver a reactive, server-side-rendered experience compatible with traditional shared hosting (GoDaddy cPanel / LiteSpeed) without requiring a Node.js server runtime in production.

---

## Technical Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| Admin CRM | Filament v5 |
| Public Storefront | Livewire v4 |
| Styling | Tailwind CSS (compiled via Vite) |
| Media Library | Spatie Laravel Media Library v11 |
| Database (Local) | SQLite |
| Database (Production) | MySQL |
| PHP Requirement | PHP 8.3+ |

---

## Project Structure

```
hailerz/
├── app/
│   ├── Filament/Resources/     # Admin CRM panels
│   │   ├── Talent/
│   │   ├── Inquiries/
│   │   ├── Submissions/
│   │   ├── Posts/
│   │   ├── Contents/
│   │   └── EmailTemplates/
│   ├── Livewire/               # Public-facing reactive components
│   │   └── Public/
│   └── Models/
├── bin/
│   ├── deploy.sh               # Automated local-to-production deployment
│   └── remote-setup.sh         # One-time server environment setup
├── database/
│   ├── data/                   # JSON seed data files
│   ├── migrations/
│   └── seeders/
└── resources/views/livewire/   # Blade templates for Livewire components
```

---

## Admin Panel (Filament)

Access the admin panel at `/admin`. The panel is protected by Filament's built-in authentication.

### Resources

| Resource | Description |
|---|---|
| Talent | Full CRUD for artist profiles, including headshots, PDF riders, dynamic pricing, genre tags, video URL, and featured status |
| Inquiries | Booking pipeline to track event requests from initial lead through to confirmed |
| Submissions | Review portal for prospective artists applying to join the agency talent |
| Posts | Editorial CMS for news articles and blog content |
| Contents | Lightweight resource manager for downloadable industry guides and assets |
| Email Templates | Template builder for outbound transactional and campaign emails sent from the admin panel |

---

## Public Storefront (Livewire)

All public routes are server-side rendered by Livewire for SEO compatibility. No client-side routing is used.

| Route | Component | Description |
|---|---|---|
| `/` | `Home` | Landing page |
| `/talent` | `TalentDirectory` | Reactive talent grid with category filtering |
| `/talent/{slug}` | `ShowTalent` | Individual artist profile page |
| `/book` | `BookingWizard` | Multi-step event inquiry form |
| `/book/confirm` | `BookingConfirmation` | Booking confirmation page |
| `/about` | `About` | About page |
| `/services` | `Services` | Services overview page |
| `/contact` | `Contact` | Contact form |
| `/join` | `JoinTalent` | Artist application portal |
| `/news` | `PostList` | News and editorial listing |
| `/news/{slug}` | `ShowPost` | Individual article view |
| `/legal/terms` | `TermsOfService` | Terms of service |
| `/legal/privacy` | `PrivacyPolicy` | Privacy policy |
| `/legal/booking` | `BookingAgreement` | Booking agreement |
| `/legal/cancellation` | `CancellationPolicy` | Cancellation policy |
| `/maintenance` | Blade view | Maintenance mode splash page |

---

## Local Development Setup

### Prerequisites

- PHP 8.3+
- Composer
- Node.js and npm
- SQLite (usually bundled with PHP)

### Step-by-Step

**1. Clone and install dependencies**

```bash
git clone <repository-url>
cd hailerz
composer install
npm install
```

**2. Configure the environment**

```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` and set the following application-specific variables:

```env
APP_NAME="Hailerz"
APP_URL=http://localhost:8000

ADMIN_NAME="Hailerz Admin"
ADMIN_EMAIL="admin@hailerz.com"
ADMIN_PASSWORD="YourSecurePassword123!"
```

**3. Set up the database**

The application uses SQLite for local development:

```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

The seeder reads JSON files from `database/data/` and creates seed records for all tables. The Admin user is created automatically based on your `ADMIN_EMAIL` and `ADMIN_PASSWORD` variables.

**4. Link storage**

```bash
php artisan storage:link
```

**5. Boot the development servers**

```bash
# Option A: Run everything with one command (uses concurrently)
composer dev

# Option B: Run servers separately
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

`composer dev` boots the PHP server, queue listener, Pail log viewer, and Vite dev server simultaneously.

---

## Environment Variables Reference

The following variables are specific to Hailerz and are not part of the standard Laravel defaults:

| Variable | Description |
|---|---|
| `ADMIN_NAME` | Display name for the initial seeded admin user |
| `ADMIN_EMAIL` | Email address used to log into the Filament admin panel |
| `ADMIN_PASSWORD` | Password for the initial admin user |

### Mail Configuration (Gmail SMTP)

To enable email sending from the admin panel, configure the following in your `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Important:** Gmail requires an App Password, not your regular Google account password.

To generate one:
1. Enable 2-Step Verification on your Google Account.
2. Go to Google Account > Security > App Passwords.
3. Generate a new password and paste it as `MAIL_PASSWORD`.

---

## Common Development Tasks

### Database

```bash
# Re-seed without wiping (appends)
php artisan db:seed

# Full reset and reseed
php artisan migrate:fresh --seed

# Create a new migration
php artisan make:migration create_table_name_table

# Run pending migrations
php artisan migrate
```

### Filament Admin Resources

```bash
# Generate a new resource
php artisan make:filament-resource ModelName
```

Move generated classes into a descriptive subfolder under `app/Filament/Resources/` to maintain organization (e.g., `app/Filament/Resources/Talent/`).

### Livewire Components

```bash
# Generate a new component
php artisan make:livewire Public/ComponentName
```

Components are stored in `app/Livewire/` with corresponding Blade views in `resources/views/livewire/`.

### Cache

```bash
# Clear config cache (required after any .env change)
php artisan config:clear

# Full optimization (run after deployments)
php artisan optimize
php artisan filament:optimize
```

---

## Production Deployment

The production environment is a GoDaddy shared hosting account running Apache/LiteSpeed with cPanel. The live application is served from `public_html`, which is symlinked to the `hailerz/public` directory.

### SSH Alias

All deployment scripts assume an SSH alias named `godaddy-hailerz` is configured in your local `~/.ssh/config`:

```
Host godaddy-hailerz
    HostName your-server-ip
    User your-cpanel-username
    IdentityFile ~/.ssh/your-key
```

---

### Initial Server Setup (One-Time)

Before deploying for the first time, complete the following steps in GoDaddy cPanel:

**1. Create the MySQL database**

Use the MySQL Database Wizard in cPanel to create a database and a user. Grant ALL PRIVILEGES to that user on the database.

**2. Create the symlink for the public directory**

```bash
ssh godaddy-hailerz 'bash -s' < bin/remote-setup.sh
```

Or manually:

```bash
mv public_html public_html_backup
ln -s /home/apa780681/hailerz/public /home/apa780681/public_html
```

**3. Create the production `.env`**

SSH into the server and create `/home/apa780681/hailerz/.env` manually. The `.env` file is never uploaded by the deployment script to prevent overwriting production secrets.

Minimum required production values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
APP_KEY=                        # Generated on first deploy via php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

ADMIN_EMAIL=admin@yourdomain.com
ADMIN_PASSWORD=YourSecurePassword123!

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Hailerz"
```

**4. Verify PHP version**

The server PHP CLI must be 8.3+. If the version mismatches, update the `platform.php` version in `composer.json` to match the server version.

---

### Standard Deployment (Automated)

To deploy updates from your local machine:

```bash
chmod +x bin/deploy.sh
./bin/deploy.sh
```

The script performs the following steps automatically:

1. Compiles production assets locally with `npm run build`
2. Installs Composer dependencies without dev packages
3. Packages the project into `deploy.zip`, excluding `node_modules/`, `.git/`, `.env`, logs, tests, and bin scripts
4. Uploads the zip to the server via SCP using the `godaddy-hailerz` SSH alias
5. SSHs into the server and runs: unzip, permission fixes, `php artisan migrate --force`, `storage:link`, `optimize`, and `filament:optimize`
6. Deletes the zip from the server to save space

---

### Manual Deployment

If the script cannot be used, follow these steps:

```bash
# 1. Build locally
npm run build
composer install --optimize-autoloader --no-dev

# 2. Package
zip -r hailerz.zip . -x "node_modules/*" -x ".git/*" -x ".env"

# 3. Upload
scp hailerz.zip godaddy-hailerz:/home/apa780681/

# 4. Remote: extract and initialize
ssh godaddy-hailerz
cd hailerz
unzip -o ../hailerz.zip
php artisan key:generate
php artisan migrate --force --seed
php artisan storage:link
php artisan optimize
php artisan filament:optimize
```

---

## Environment Management

The `.env` file is intentionally excluded from the deployment script and version control. It must be managed manually on the server.

- To update a production environment variable: `ssh godaddy-hailerz` then `nano /home/apa780681/hailerz/.env`
- After any `.env` change on the server, always run:

```bash
php artisan config:clear
php artisan optimize
```

---

## Cron Job (Production)

The Laravel scheduler must be registered as a cron job in cPanel. Without it, scheduled tasks and internal Filament notifications will not run.

In cPanel > Cron Jobs, add the following:

```
* * * * * /usr/local/bin/php /home/apa780681/hailerz/artisan schedule:run >> /dev/null 2>&1
```

Interval: Every Minute

---

## Permissions Reference (GoDaddy / LiteSpeed)

| Target | Permission |
|---|---|
| All files | 644 |
| All directories | 755 |
| `storage/` | 775 (recursive) |
| `bootstrap/cache/` | 775 (recursive) |

The `bin/remote-setup.sh` script applies these automatically.
