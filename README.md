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

- Product listing with category grouping  
- User authentication and role-based access  
- Transaction management with manual payment confirmation  
- RESTful API endpoints  
- Responsive and clean UI  
- PDF invoice generation and email notification  

The project is published in a public GitHub repository following good development practices.

---

## 2. Tech Stack

### Backend
- Laravel 12
- PHP 8.3
- Laravel Breeze (authentication)
- Laravel Sanctum (API authentication)

### Frontend
- Blade Templates
- Tailwind CSS
- Vanilla JavaScript

### Database
- MySQL / SQLite (configurable)

### External Packages
| Package | Purpose |
|------|------|
| laravel/breeze | Authentication scaffolding |
| laravel/sanctum | API authentication |
| barryvdh/laravel-dompdf | PDF invoice generation |
| fakerphp/faker | Database seeding |
| laravel/pint | Code formatting |

---

## 3. User Roles

The system supports two roles:

### Admin
- Manage users and roles
- Manage categories and products
- View and manage all transactions
- Confirm customer payments
- Export invoices (PDF)

### Customer
- Browse products
- Create transactions
- Submit payment confirmation
- View transaction history
- Download invoice (PDF)

---

## 4. Database Structure

Main tables:
- users  
- roles  
- categories  
- products  
- transactions  

Seeders are provided for:
- Users  
- Roles  

---

## 5. Transaction Flow

Transactions follow a clear state-based flow:

1. `pending`  
2. `awaiting_payment`  
3. `paid`  
4. `cancelled`  
5. `expired`  

### Payment Handling
- Payment is **manual**
- Customer submits payment confirmation
- Admin verifies and confirms payment
- Email notification is sent when payment is confirmed

---

## 6. RESTful API

### Authentication
- API is secured using **Laravel Sanctum**

### Available API Resources
- Products
- Transactions

API documentation is provided via **Postman collection**.

---

## 7. PDF & Reporting

- Invoice PDF generation for transactions
- Implemented using `barryvdh/laravel-dompdf`

---

## 8. Email Notification

- Email notification is sent when a transaction is marked as **paid**
- SMTP service: **Mailtrap**

---

## 9. UI / UX

- Public landing page
- Admin dashboard
- Responsive design for desktop and mobile
- Responsive tables with horizontal overflow handling
- Clean and minimal navigation

---

 ## 10.Installation

### Requirements
- PHP >= 8.3
- Composer
- Node.js & npm
- MySQL or SQLite

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

 ## 11. Default Seeder Accounts

The following accounts are automatically created using database seeders for testing purposes:

| Role     | Email               | Password |
|----------|---------------------|----------|
| Admin    | admin@marketing.com   | 123456789 |
| Customer | customer@marketing.com| 123456789 |

> You may modify these credentials directly in the seeder files if needed.

---

 ## 12. Access Control & Security

- Role-based access control is enforced using middleware
- Admin and Customer have strictly separated routes and permissions
- Unauthorized access to restricted pages will be blocked
- Invalid transaction actions (e.g. paying a cancelled transaction) are prevented at controller level

---

 ## 13. Guard & Negative Test Scenarios

The system includes guard checks to prevent invalid actions, such as:

- Customer accessing admin-only routes
- Attempting to pay a cancelled or expired transaction
- Confirming an already paid transaction
- Accessing transactions that do not belong to the authenticated user

These checks ensure transaction integrity and system consistency.

---

 ## 14. API Documentation

- REST API endpoints are available for:
  - Products
  - Transactions
- All API routes are protected using **Laravel Sanctum**
- A Postman collection is included in the repository for testing and documentation

---

 ## 15. Project Scope & Limitations

- Payment gateway integration is **intentionally excluded**
- Manual payment confirmation is used to focus on:
  - Transaction state management
  - Authorization logic
  - Admin verification flow
- This design choice aligns with the scope of a technical assessment project

---

 ## 16. Project Status

- Core features: ✅ Completed
- Optional enhancements (SSO, external payment gateway): ❌ Not implemented
- Codebase is structured, readable, and ready for further extension

---

## 17. License

This project is open-sourced under the **MIT License**.




