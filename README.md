# Evidencija Radnog Vremena v2

**Work Time Tracking System** — A web application for managing employee work records, task assignments, and company partnerships, built with Laravel 11.

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Database Schema](#database-schema)
- [Getting Started](#getting-started)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [License](#license)

---

## Overview

**Evidencija Radnog Vremena v2** (Work Time Records v2) is a role-based web application designed for organizations to track and manage employee work time. It allows administrators to define tasks, assign them to employees, and monitor progress — while employees can log their daily work hours against specific tasks and activity types.

---

## Features

- **Authentication** — Secure registration and login with session-based authentication
- **Role-Based Access Control** — Separate views and permissions for administrators and employees
- **User Management** — Administrators can view, edit, and delete employee accounts
- **Task Management** — Create tasks linked to company profiles, activity types, and statuses; assign multiple users to a task
- **Work Time Records (Evidencija)** — Employees log daily work entries with date, hours, task, and activity type
- **Company Profiles** — Maintain a directory of partner/client companies with partnership dates
- **Sections & Roles** — Manage organizational departments and user roles from the admin settings panel
- **Global Search** — Search across users, tasks, and companies from the navigation bar

---

## Tech Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.2+ |
| Framework | Laravel 11 |
| Database | SQLite (local) |
| Frontend | Blade Templates, Bootstrap 5.3 |
| Build Tool | Vite 6 |
| CSS | Tailwind CSS 3, Bootstrap Icons |
| HTTP Client | Axios |
| Testing | PHPUnit 11 |

---

## Database Schema

```
roles               — User roles (e.g. Admin, Employee)
section_rooms       — Organizational departments/sections
users               — Employee accounts (linked to role and section)
company_profiles    — Partner/client company records
activity_types      — Types of work activities
task_statuses       — Task lifecycle statuses
tasks               — Work tasks with metadata and company/activity links
task_user           — Pivot table: many-to-many user-task assignments
evidencija          — Individual daily work time log entries
sessions            — Laravel session storage
cache / jobs        — Laravel framework infrastructure tables
```

---

## Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm

### Installation

```bash
# Clone the repository
git clone https://github.com/mljeva1/erv_v2.git
cd erv_v2

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Copy environment file and generate application key
cp .env.example .env
php artisan key:generate

# Create the SQLite database file
touch database/database.sqlite

# Run migrations
php artisan migrate

# (Optional) Seed the database
php artisan db:seed

# Build frontend assets
npm run build

# Start the development server
php artisan serve
```

The application will be available at `http://localhost:8000`.

---

## Usage

### Roles

| Role | Capabilities |
|---|---|
| **Admin** (role_id = 1) | Full access: users, tasks, companies, settings, search, work records |
| **Employee** (role_id = 2) | Log work time records, view tasks |

### Key Pages

| URL | Description |
|---|---|
| `/` | Dashboard — total tasks and user statistics |
| `/login` | User login |
| `/register` | User registration |
| `/users` | User management (admin only) |
| `/tasks` | Task listing with status filtering |
| `/evidencija` | Work time records (authenticated users) |
| `/evidencija/create` | Log a new work time entry |
| `/company_profiles` | Company/partner directory |
| `/settings` | Manage sections and roles (admin only) |
| `/search?query=...` | Global search across users, tasks, and companies |

---

## Vercel Deployment

This repository is configured for Vercel as a Laravel PHP application, not as a static Vite app.

Important Vercel settings:

| Setting | Value |
|---|---|
| Framework Preset | Other |
| Install Command | `npm ci` |
| Build Command | `npm run build` |
| Output Directory | `public` |

The output directory must be `public`. Laravel serves from `public/index.php`, and Vite writes compiled assets to `public/build`; this project does not generate a root `dist` directory.

Do not set the Vercel Install Command to `composer install ...`. The PHP dependencies are handled by the `vercel-php` function runtime; the project-level install/build only needs Node dependencies for Vite.

Set these environment variables in the Vercel dashboard:

```bash
APP_KEY=base64:...
APP_URL=https://your-vercel-domain.vercel.app
DB_SYNC_URL=libsql://<database>.turso.io
DB_AUTH_TOKEN=<turso-auth-token>
```

Generate `APP_KEY` locally with:

```bash
php artisan key:generate --show
```

Do not commit `.env` or production secrets to Git.

---

## Project Structure

```
app/
├── Http/Controllers/       # Application controllers
│   ├── AuthController.php
│   ├── UserController.php
│   ├── TaskController.php
│   ├── EvidencijaController.php
│   ├── CompanyProfileController.php
│   ├── SectionRoomController.php
│   ├── RoleController.php
│   └── SearchController.php
├── Models/                 # Eloquent models
│   ├── User.php
│   ├── Task.php
│   ├── Evidencija.php
│   ├── CompanyProfile.php
│   ├── ActivityType.php
│   ├── TaskStatus.php
│   ├── SectionRoom.php
│   └── Role.php
database/
├── migrations/             # Database schema definitions
└── seeders/                # Database seeders
resources/
└── views/                  # Blade templates
    ├── layouts/app.blade.php
    ├── home/
    ├── auth/
    ├── users/
    ├── tasks/
    ├── evidencija/
    ├── company_profile/
    ├── section_role/
    └── search/
routes/
└── web.php                 # Application routes
```

---

## License

This project is open-source and available under the [MIT License](https://opensource.org/licenses/MIT).
