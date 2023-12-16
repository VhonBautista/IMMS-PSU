# IMMS PSU (Instructional Material Management System for Pangasinan State University)
## Installation Instructions

### Prerequisites
- Git installed on your machine
- Composer installed on your machine
- Node.js installed on your machine
- PHP installed on your machine
- Laravel installed on your machine

### Installation Steps

1. **Clone the Application:**
   ```bash
   git clone https://github.com/your-username/imms-psu.git

2. **Create a Database:**
   * Open your xampp.
   * Open your phpmyadmin.
   * Create a new database named **imms_psu**.

3. **Install PHP Dependencies:**
   ```bash
   composer install
   
4. **Install JavaScript Dependencies:**
   ```bash
   npm install

5. **Compile Assets:**
   ```bash
   npm run dev

6. **Run Migrations:**
   ```bash
   php artisan migrate
   
7. **Seed the Database:**
   ```bash
   php artisan db:seed
   
8. **Login Using Main Account:**
  * Email: **main@psu.edu.ph**
  * Password: **password**

**Congratulations!** Your IMMS is now set up and ready for use. You can log in with the provided main account credentials to explore the application's features.
