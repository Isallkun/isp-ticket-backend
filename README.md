# ISP Ticket Management System

<p align="center">
  <img src="https://img.icons8.com/color/96/000000/ticket.png" alt="ISP Ticket System" width="80"/>
</p>

<p align="center">
  <strong>Sistem Manajemen Tiket Gangguan ISP</strong><br>
  Solusi modern untuk mengelola laporan gangguan pelanggan dengan efisien dan terstruktur
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.33.0-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/MySQL-8.0+-green" alt="MySQL Version">
  <img src="https://img.shields.io/badge/Bootstrap-5.3.0-purple" alt="Bootstrap Version">
</p>

## 🌟 Fitur Utama

### Role-Based Access Control (RBAC)

Sistem dirancang dengan 3 role yang sesuai dengan alur kerja ISP:

-   **🎧 Customer Service (CS)**: Garda terdepan yang berinteraksi langsung dengan pelanggan

    -   ✅ Mendaftarkan pelanggan baru
    -   ✅ Membuat tiket gangguan
    -   ✅ Mengelola data pelanggan
    -   ✅ Melihat tiket yang dibuat

-   **🔧 NOC Agent**: Memproses tiket gangguan dan penanganan teknis

    -   ✅ Melihat semua tiket
    -   ✅ Memperbarui status tiket
    -   ✅ Menetapkan prioritas dan penugasan
    -   ✅ Edit dan hapus tiket

-   **👨‍💼 Administrator**: Kendali penuh sistem
    -   ✅ Mengelola semua data
    -   ✅ Manajemen user accounts
    -   ✅ Monitoring dan laporan analitik
    -   ✅ Full system access

### 🎫 Manajemen Tiket

-   ✅ Pembuatan tiket gangguan dengan prioritas (Low, Medium, High, Critical)
-   ✅ Status tracking (Open, In Progress, Resolved, Closed)
-   ✅ Timeline perubahan status dengan activity log
-   ✅ Filtering dan searching tiket
-   ✅ Kategori gangguan (Internet, Telepon, TV, Lainnya)

### 👥 Manajemen Pelanggan

-   ✅ Registrasi pelanggan baru
-   ✅ Data pelanggan lengkap (nama, email, telepon, alamat)
-   ✅ History tiket per pelanggan
-   ✅ CRUD operations dengan validasi

### 📊 Dashboard Dinamis

-   ✅ Role-specific dashboard dengan informasi relevan
-   ✅ Statistik real-time tiket (Total, Open, In Progress, Resolved)
-   ✅ Quick actions berdasarkan role dan permission
-   ✅ Chart visualisasi status tiket dengan Chart.js

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 12.33.0
-   **Frontend**: Bootstrap 5.3.0 + Blade Templates
-   **Database**: MySQL
-   **Authentication**: Laravel's built-in authentication dengan role-based system
-   **Styling**: Custom CSS dengan gradient modern dan animasi smooth
-   **Icons**: Font Awesome 6.0.0
-   **Charts**: Chart.js untuk visualisasi data

## 📋 Prerequisites

-   PHP 8.2+
-   MySQL 8.0+
-   Composer
-   Node.js & NPM (untuk assets compilation jika diperlukan)

## 🚀 Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/Isallkun/isp-ticket-backend
    cd isp-ticket-backend
    ```

2. **Install Dependencies**

    ```bash
    composer install
    npm install
    ```

3. **Environment Setup**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Database Configuration**
   Edit file `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=isp_ticket_system
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5. **Run Migration**

    ```bash
    php artisan migrate
    ```

6. **Serve Application**

    ```bash
    php artisan serve
    ```

7. **Access Application**
    - URL: `http://127.0.0.1:8000`
    - Register admin account pertama Anda dengan role "Admin"

## 📁 Struktur Project

```
isp-ticket-backend/
├── app/
│   ├── Helpers/
│   │   └── RoleHelper.php              # Role management utilities
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php    # Authentication logic
│   │   │   ├── CustomerController.php # Customer management
│   │   │   ├── TicketController.php   # Ticket management
│   │   │   └── UserController.php      # User management (Admin only)
│   │   ├── Middleware/
│   │   │   ├── PermissionMiddleware.php # Permission-based access
│   │   │   └── RoleMiddleware.php       # Role-based access
│   │   └── Requests/
│   ├── Models/
│   │   ├── Customer.php              # Customer model
│   │   ├── Ticket.php                 # Ticket model
│   │   ├── TicketLog.php              # Ticket activity log
│   │   └── User.php                   # User model dengan role methods
├── database/
│   └── migrations/                     # Database schema
├── resources/
│   ├── views/
│   │   ├── auth/                      # Authentication views
│   │   ├── customers/                 # Customer management views
│   │   ├── tickets/                   # Ticket management views
│   │   ├── users/                     # User management views (Admin)
│   │   ├── home.blade.php             # Dynamic dashboard
│   │   └── layouts/
│   │       └── sidebar.blade.php      # Main layout dengan navigation
│   └── assets/                        # Static assets
├── routes/
│   └── web.php                        # Web routes dengan role protection
└── README.md
```

## 🔐 Role & Permission System

### Role Hierarchy

1. **Admin** - Level 3: Full system access
2. **NOC Agent** - Level 2: Ticket processing & technical operations
3. **Customer Service** - Level 1: Customer interaction & ticket creation

### Permission Matrix

| Fitur               | Admin | NOC Agent | Customer Service |
| ------------------- | ----- | --------- | ---------------- |
| Dashboard           | ✅    | ✅        | ✅               |
| Buat Tiket          | ✅    | ✅        | ✅               |
| Edit Tiket          | ✅    | ✅        | ❌               |
| Update Status       | ✅    | ✅        | ❌               |
| Hapus Tiket         | ✅    | ✅        | ❌               |
| Lihat Tiket         | ✅    | ✅        | ✅ (Own)         |
| Manajemen Pelanggan | ✅    | ✅        | ✅               |
| Manajemen User      | ✅    | ❌        | ❌               |

## 🎯 Alur Kerja Sistem

1. **Customer Service** menerima laporan gangguan dari pelanggan
2. **CS** membuat tiket dengan informasi lengkap dan prioritas
3. **NOC Agent** menerima tiket dan melakukan analisis teknis
4. **NOC** memperbarui status tiket sesuai progres penanganan
5. **Admin** memonitor keseluruhan operasional sistem

## 🎨 UI/UX Features

-   **Modern Design**: Gradient backgrounds dengan animasi smooth
-   **Responsive**: Optimal untuk desktop dan mobile
-   **Interactive**: Hover effects, transitions, dan micro-interactions
-   **Role-Specific**: Menu dan dashboard yang beradaptasi berdasarkan role
-   **User-Friendly**: Intuitive navigation dan clear visual hierarchy

## 🔧 Development Features

-   **Role-Based Middleware**: Secure access control dengan `RoleMiddleware` dan `PermissionMiddleware`
-   **Helper Classes**: Modular dan reusable code dengan `RoleHelper`
-   **Custom Validation**: Input validation dengan error handling
-   **Logging**: Complete activity tracking dengan `TicketLog`
-   **Database Relations**: Proper Eloquent relationships
-   **Security**: CSRF protection dan session management

## 📊 Database Schema

### Users Table

```sql
- id (Primary Key)
- name
- email (Unique)
- password (Hashed)
- role (Enum: Admin, CS, NOC)
- timestamps
```

### Customers Table

```sql
- id (Primary Key)
- name
- email (Unique)
- phone
- address
- timestamps
```

### Tickets Table

```sql
- id (Primary Key)
- customer_id (Foreign Key)
- title
- description
- priority (Low, Medium, High, Critical)
- status (Open, In Progress, Resolved, Closed)
- category
- assigned_to
- timestamps
```

### TicketLogs Table

```sql
- id (Primary Key)
- ticket_id (Foreign Key)
- status
- user_id (Foreign Key)
- timestamps
```

## 🚀 Deployment Notes

### Environment Variables

```env
APP_NAME="ISP Ticket System"
APP_ENV=production
APP_KEY=your_app_key
APP_DEBUG=false
APP_URL=your_domain

DB_CONNECTION=mysql
DB_HOST=your_host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Production Setup

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
```

## 🎫 API Endpoints

### Authentication

-   `POST /login` - User login
-   `POST /register` - User registration
-   `POST /logout` - User logout

### Tickets

-   `GET /tickets` - List tickets (role-based filtering)
-   `POST /tickets` - Create new ticket
-   `GET /tickets/{id}` - Get ticket details
-   `PUT /tickets/{id}` - Update ticket
-   `DELETE /tickets/{id}` - Delete ticket
-   `PATCH /tickets/{id}/status` - Update ticket status

### Customers

-   `GET /customers` - List customers
-   `POST /customers` - Create customer
-   `GET /customers/{id}` - Get customer details
-   `PUT /customers/{id}` - Update customer
-   `DELETE /customers/{id}` - Delete customer

### Users (Admin Only)

-   `GET /users` - List users
-   `POST /users` - Create user
-   `GET /users/{id}` - Get user details
-   `PUT /users/{id}` - Update user
-   `DELETE /users/{id}` - Delete user

## 🤝 Kontribusi

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

**© 2025 ISP Ticket Management System. All rights reserved.**

_Built with ❤️ using Laravel_
