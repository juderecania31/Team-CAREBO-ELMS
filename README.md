# Team-CAREBO-ELMS
Capstone Project Repository for Employee Leave Management System.


# Employee Leave Management System (ELMS)

## Table of Contents
1. [Overview](#overview)
2. [Current Status](#current-status)
3. [System Requirements](#system-requirements)
4. [Installation](#installation)
5. [Planned Features](#planned-features)
6. [Contact](#contact)

## Overview
The Employee Leave Management System (ELMS) is a project aimed at automating leave management and integrating payroll features to enhance organizational efficiency. The system is being developed for deployment at **Cedar College Inc.**.

## Current Status
The system is **under development** and currently includes the following features:
- User login and signup pages.
- Basic admin dashboard.
- Initial configuration file for database connectivity (`config.php`).

## System Requirements
- Development Environment: XAMPP
- Backend: MySQL
- Languages: PHP, HTML, CSS, JavaScript

## Installation
Step 1: Setting Up XAMPP
1. Download and install [XAMPP](https://www.apachefriends.org/index.html).
2. Install XAMPP on your computer and launch the Control Panel.
3. Start the Apache and MySQL modules from the XAMPP Control Panel.

Step 2: Obtaining the Project Files
Download the ZIP File
1. Ensure Git is installed on your system. If not, download it from (https://desktop.github.com/download/).
2. Extract the contents of the ZIP file to the htdocs folder of your XAMPP installation.

Step 3: Setting Up the Database
1. Open your browser and navigate to http://localhost/phpmyadmin.
2. Create a database named `employee_leave`.
3. Import the SQL file (employee_leave.sql) into the leave_management database.
4. Place the project files (`config.php`, `index.php`, `login.php`, `signup.php`, `admin_dashboard.php`) into your `htdocs` folder.

Step 4: Configuring the Application
1. Open the config.php file in a text editor.
2. Ensure the database connection settings match your XAMPP configuration:

Step 5: Running the Project
1. Open your browser and go to http://localhost/your-project-folder.
2. Use the login or signup functionality to access the system.

## Planned Features
- Leave Management:
  - Leave request and approval workflows.
  - Leave policy customization.
  - Public holiday management.
- Payroll Integration:
  - Automated salary calculations and leave deductions.
- Security and Customization:
  - Two-Factor Authentication.
  - User roles and permissions.
- Reporting:
  - Audit logs and exportable reports.
- Other Enhancements:
  - Real-time dashboards.
  - Multi-language support.
  - Backup and recovery.

## Contact
For questions or updates on the project, contact:
- Name: Jude Recania
- Email: juderecania123@gmail.com
- Organization: Cedar College Inc.
