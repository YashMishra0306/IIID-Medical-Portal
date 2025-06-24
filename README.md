# IIID-Medical-Portal
# IIIT Medical Portal

A PHP + MySQL-based web application built using XAMPP to automate the process of issuing and tracking medical certificates within IIITs across India.

## 🔐 User Roles

- **Student**: Can view their visits, certificates, and related records.
- **Doctor**: Can issue certificates and manage visit records.
- **Admin**: Can view all student data, run specific queries, and manage the system.

## 🚀 Features

- Login system for Students, Doctors, and Admins.
- Role-based dashboards and access control.
- Dynamic SQL query forms mapped to real-time data.
- Medical certificate issuance and exam tracking.
- Responsive GUI built with HTML/CSS and PHP backend.

## 🗃 Folder Structure
IIIT_Medical_Portal/
├── includes/
│ └── db_connection.php
├── login.php
├── logout.php
├── index.php
├── run_queries.php
├── student_dashboard.php
├── doctor_dashboard.php
├── admin_dashboard.php
├── queries/
│ ├── query1.php ... query10.php
├── medical_records.php
├── styles/
│ └── style.css



## 🛠️ Tech Stack

- PHP (Backend)
- MySQL (Database)
- HTML/CSS (Frontend)
- XAMPP (Local Server)

## 📝 Setup Instructions

1. Install XAMPP and start Apache + MySQL.
2. Place the folder in `htdocs` directory.
3. Create the `iiit_medical` database in phpMyAdmin.
4. Import the provided `.sql` file to create tables and insert data.
5. Open `http://localhost/IIIT_Medical_Portal` in your browser.

## 🔐 Default Admin Credentials

Email: any registered admin email
Password: admin@123
