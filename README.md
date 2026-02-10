<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.3-blue" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Auth-Google%20SSO%20%2B%20Email-success" alt="Auth">
  <img src="https://img.shields.io/badge/Status-Completed-success" alt="Project Status">
  <img src="https://img.shields.io/badge/License-MIT-lightgrey" alt="License">
</p>

# Simple Marketplace System

A **simple marketplace system** built with **Laravel 12**, designed to demonstrate **clean architecture**, **strict role separation**, and a **well-defined transaction state machine**.

This project is built as a **technical assessment & portfolio project**, with emphasis on backend correctness, access control, and real-world constraints rather than feature quantity.

---

## 1. Project Goals

This project focuses on implementing a realistic marketplace flow with clear boundaries:

* Role-based authentication (Admin & Customer)
* Product and category management
* Transaction lifecycle with state enforcement
* Manual payment confirmation workflow
* RESTful API with token-based authentication
* PDF invoice generation and email notification
* Google OAuth login with explicit security rules

The repository follows structured commits, clear separation of concerns, and defensive authorization logic.

---

## 2. Tech Stack

### Backend

* Laravel 12
* PHP 8.3
* Laravel Breeze (session-based auth)
* Laravel Sanctum (API authentication)
* Laravel Socialite (Google OAuth)

### Frontend

* Blade Templates
* Tailwind CSS
* Vanilla JavaScript

### Database

* MySQL / SQLite (configurable)

### Key Packages

| Package                 | Purpose                    |
| ----------------------- | -------------------------- |
| laravel/breeze          | Authentication scaffolding |
| laravel/sanctum         | API authentication         |
| laravel/socialite       | Google OAuth               |
| barryvdh/laravel-dompdf | PDF invoice generation     |
| laravel/pint            | Code formatting            |

---

## 3. Authentication Design

### Supported Methods

* Email & password (Breeze)
* Google OAuth 2.0 (Socialite)

### Hard Rules (Intentional Design)

* **Google SSO is customer-only**
* Users with `provider = google` **cannot log in using email/password**
* Email/password login is reserved for non-Google users
* Multi-provider OAuth is intentionally **not supported**

If a Google-registered user attempts to log in via the email/password form, the system blocks the attempt and instructs them to continue with Google.

This prevents account takeover scenarios and enforces a single authentication source of truth.

---

## 4. User Roles

### Admin

* Manage users and roles
* Manage categories and products
* View and manage all transactions
* Confirm customer payments
* Download invoice PDFs

### Customer

* Browse products
* Create transactions
* Submit payment confirmation
* View transaction history

Admin and Customer routes are strictly separated using middleware and role guards.

---

## 5. Transaction Lifecycle

Transactions follow a strict state machine:

1. `pending`
2. `awaiting_payment`
3. `paid`
4. `cancelled`
5. `expired`

### Payment Handling

* Payments are **manual by design**
* Customer submits payment confirmation
* Admin verifies and confirms payment
* Email notification is sent upon confirmation or expiration

This design intentionally excludes payment gateways to focus on:

* State validation
* Authorization rules
* Admin verification workflow

---

## 6. RESTful API

### Authentication

* API authentication uses **Laravel Sanctum**
* All protected endpoints require a valid **Bearer Token**

### Available Resources

**Authentication**

* Login
* Logout

**Products**

* List products (paginated)
* View product details

**Transactions (Customer)**

* List own transactions
* Create transaction
* Pay transaction
* Cancel transaction

**Transactions (Admin)**

* List all transactions
* Filter by status
* Confirm payment
* Auto-expire invalid transactions
* Download invoice (PDF)

---

## 7. API Documentation

Complete API documentation is published via Postman:

🔗 [https://documenter.getpostman.com/view/40291601/2sBXc8oiR3](https://documenter.getpostman.com/view/40291601/2sBXc8oiR3)

Includes:

* Example requests & responses
* Error scenarios (401 / 403 / 422)
* Pagination format
* Role-based access rules

---

## 8. PDF & Email System

* Invoice PDFs are generated for **paid transactions only**
* Implemented using `laravel-dompdf`
* PDFs are generated on-demand and **not stored on disk**

### Email Notifications

* Sent when a transaction is:

  * Confirmed as **paid**
  * Marked as **expired**
* SMTP provider: **Brevo**
* Invoice PDF is attached to the email

---

## 9. UI / UX Overview

* Public landing page
* Admin dashboard
* Customer dashboard
* Responsive layout (desktop & mobile)
* Clean navigation and guarded routes

---

## 10. Installation

### Requirements

* PHP >= 8.3
* Composer
* Node.js & npm
* MySQL or SQLite

### Setup

```bash
git clone https://github.com/your-username/simple-marketplace-system.git
cd simple-marketplace-system

composer install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed

npm install
npm run build

php artisan serve
```

---

## 11. Default Seeder Accounts

| Role     | Email                                                   | Password  |
| -------- | ------------------------------------------------------- | --------- |
| Admin    | [admin@marketing.com](mailto:admin@marketing.com)       | 123456789 |
| Customer | [customer@marketing.com](mailto:customer@marketing.com) | 123456789 |

Credentials can be changed directly in the seeder files.

---

## 12. Security & Guarding

The system explicitly blocks invalid actions, including:

* Customers accessing admin routes
* Paying cancelled or expired transactions
* Confirming transactions in invalid states
* Accessing transactions owned by other users
* Logging in with an invalid auth method (Google vs email)

Authorization is enforced at route, controller, and domain logic levels.

---

## 13. Project Scope

* Payment gateway integration is intentionally excluded
* Focus is placed on:

  * Transaction correctness
  * Authorization safety
  * Maintainable backend structure

This aligns with the scope of a technical assessment project.

---

## 14. License

MIT License
