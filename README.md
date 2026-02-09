# Lokal-Link: B2B Marketplace

Lokal-Link is a procurement platform built to connect local agricultural producers with commercial buyers. Unlike standard retail apps, this system is optimized for wholesale transactions, featuring bulk inventory management, verified producer gatekeeping, and automated supply chain logic.

## 🏗 System Architecture

The platform operates on a tripartite permission model:
* **Buyers:** Handle procurement via a cart-to-order flow, tracking wholesale purchases and historical pricing.
* **Producers:** Manage real-time inventory levels, MOQ (Minimum Order Quantities), and incoming B2B fulfillment.
* **Admins:** Act as the platform "Gatekeepers," manually verifying producer profiles before they are permitted to list products on the marketplace.

## 🚀 Key Technical Features

### 1. Smart Stock Management (Auto-Deduct)
The checkout logic includes an automated inventory trigger. Upon order confirmation, the system executes an `UPDATE` loop on `tbl_products` to subtract purchased quantities from `stock_quantity`, preventing overselling in a high-volume B2B environment.

### 2. Verification Gatekeeping
To maintain a high-trust marketplace, producers are assigned a `verified_status`. The marketplace logic is filtered to only display products from producers marked as `verified` by an Admin.

### 3. Order & Earnings Tracking
The Producer Dashboard utilizes SQL aggregations (`SUM`, `COUNT`) to calculate real-time business metrics, including total revenue from delivered orders and current pending fulfillment counts.

### 4. Security & Routing
* **Session-Based Auth:** Role-specific access control (RBAC) ensures users only access directories relevant to their `user_type`.
* **Clean Routing:** Implemented via `.htaccess` to handle URL rewriting, removing `.php` extensions for a modern SaaS-style URL structure.

## 🛠 Tech Stack
* **Back-end:** PHP 8.0+ (PDO for secure database interactions)
* **Database:** MariaDB / MySQL 
* **UI/UX:** Tailwind CSS (Modern Minimalist Design)
* **Server:** Apache (Ubuntu environment)

## 📁 Project Structure
```text
Lokal-Link/
├── public/                # Public entry point
│   ├── admin/             # Verification & Platform metrics
│   ├── auth/              # Logic for Login, Register, & Logout
│   ├── buyer/             # Procurement & Order flows
│   ├── producer/          # Inventory CRUD & Order management
│   ├── assets/            # Compiled CSS and media uploads
│   └── includes/          # DB Config, Shared Headers/Footers
└── .htaccess              # Rewriting rules for Pretty URLs
