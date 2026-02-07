<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.3-blue" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/Status-Completed-success" alt="Project Status">
  <img src="https://img.shields.io/badge/License-MIT-lightgrey" alt="License">
</p>

# Simple Marketplace System

A **simple marketplace system** built with **Laravel 12**, focusing on clean architecture, role-based access control, and a clear transaction flow.
This project is intended for **technical assessment and portfolio purposes**.

---

## 1. Objective

The goal of this project is to build a simple marketplace application that includes:

* Product listing with category grouping
* User authentication and role-based access
* Transaction management with manual payment confirmation
* RESTful API endpoints
* Responsive and clean UI
* PDF invoice generation and email notification

The project is published in a public GitHub repository following good development practices.

---

## 2. Tech Stack

### Backend

* Laravel 12
* PHP 8.3
* Laravel Breeze (authentication)
* Laravel Sanctum (API authentication)

### Frontend

* Blade Templates
* Tailwind CSS
* Vanilla JavaScript

### Database

* MySQL / SQLite (configurable)

### External Packages

| Package                 | Purpose                    |
| ----------------------- | -------------------------- |
| laravel/breeze          | Authentication scaffolding |
| laravel/sanctum         | API authentication         |
| barryvdh/laravel-dompdf | PDF invoice generation     |
| fakerphp/faker          | Database seeding           |
| laravel/pint            | Code formatting            |

---

## 3. User Roles

The system supports two roles:

### Admin

* Manage users and roles
* Manage categories and products
* View and manage all transactions
* Confirm customer payments
* Export invoices (PDF)

### Customer

* Browse products
* Create transactions
* Submit payment confirmation
* View transaction history

---

## 4. Database Structure

Main tables:

* users
* roles
* categories
* products
* transactions

Seeders are provided for:

* Users
* Roles

---

## 5. Transaction Flow

Transactions follow a clear state-based flow:

1. `pending`
2. `awaiting_payment`
3. `paid`
4. `cancelled`
5. `expired`

### Payment Handling

* Payment is **manual**
* Customer submits payment confirmation
* Admin verifies and confirms payment
* Email notification is sent when payment is confirmed

---

## 6. RESTful API Overview

The application exposes a RESTful API designed for clear separation of concerns and role-based access.

### API Authentication

* API authentication is handled using **Laravel Sanctum**
* All protected endpoints require a valid **Bearer Token**

### API Consumers

* Customer-facing applications (mobile / frontend)
* Admin tools or internal services

---

## 7. API Documentation (Postman)

Complete and up-to-date API documentation is available via **Postman Documenter**.

🔗 **API Documentation (Public):**
[https://documenter.getpostman.com/view/40291601/2sBXc8oiR3](https://documenter.getpostman.com/view/40291601/2sBXc8oiR3)

### What the documentation includes:

* Authentication endpoints
* Example requests (curl & JSON body)
* Example success responses
* Example error responses (401 / 403 / 422)
* Pagination format
* Role-based access rules

The documentation is generated directly from a **published Postman collection**, ensuring accuracy with the implemented API behavior.

---

## 8. Available API Resources

### Authentication

* Login
* Logout

### Products

* List products (paginated)
* View product details

### Transactions (Customer)

* List own transactions
* Create transaction
* Pay transaction
* Cancel transaction

### Transactions (Admin)

* List all transactions
* Filter by status
* Confirm payment
* Auto-expire invalid transactions
* Download invoice (PDF)

---

## 9. PDF & Reporting

* Invoice PDF generation for paid transactions
* Implemented using `barryvdh/laravel-dompdf`
* Invoice access is restricted to **paid** transactions only

---

## 10. Email Notification

* Email notification is sent when a transaction is:

  * Confirmed as **paid**
  * Marked as **expired**
* SMTP service used: **Brevo (SMTP)**
* Emails are sent when a transaction is confirmed as paid or marked as expired
* Invoice PDF is generated on-the-fly and attached to email (not saved on server)

---

## 11. UI / UX

* Public landing page
* Admin dashboard
* Customer dashboard
* Responsive design for desktop and mobile
* Responsive tables with horizontal overflow handling
* Clean and minimal navigation

---

## 12. Installation

### Requirements

* PHP >= 8.3
* Composer
* Node.js & npm
* MySQL or SQLite

### Steps

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

## 13. Default Seeder Accounts

The following accounts are automatically created using database seeders for testing purposes:

| Role     | Email                                                   | Password  |
| -------- | ------------------------------------------------------- | --------- |
| Admin    | [admin@marketing.com](mailto:admin@marketing.com)       | 123456789 |
| Customer | [customer@marketing.com](mailto:customer@marketing.com) | 123456789 |

> You may modify these credentials directly in the seeder files if needed.

---

## 14. Access Control & Security

* Role-based access control is enforced using middleware
* Admin and Customer have strictly separated routes and permissions
* Unauthorized access to restricted endpoints returns proper HTTP status codes (401 / 403)
* Invalid transaction actions are blocked at controller and domain logic level

---

## 15. Guard & Negative Test Scenarios

The system explicitly guards against invalid actions, including:

* Customer accessing admin-only API endpoints
* Paying cancelled or expired transactions
* Confirming transactions that are not in `awaiting_payment` state
* Accessing transactions not owned by the authenticated user

These scenarios are documented and testable via the Postman collection.

---

## 16. Project Scope & Limitations

* Payment gateway integration is **intentionally excluded**
* Manual payment confirmation is used to focus on:

  * Transaction state machine
  * Authorization rules
  * Admin verification workflow

This design aligns with the scope of a technical assessment project.

---

## 17. Project Status

* Core features: ✅ Completed
* API documentation: ✅ Published
* Optional enhancements (SSO, external payment gateway): ❌ Not implemented
* Codebase is structured, readable, and ready for extension

---

## 18. License

This project is open-sourced under the **MIT License**.
