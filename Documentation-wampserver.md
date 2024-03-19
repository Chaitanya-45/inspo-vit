# Database Setup Documentation

## Project: [Codeoholics Web Portal]

### Introduction

This document provides instructions on setting up the database for the [Codeoholics Web Portal] project using WampServer. The project uses a MySQL database to manage user information for sign-up and login functionality.

### Prerequisites

- **WampServer**: Make sure you have WampServer installed on your local development environment. If not, you can download it from the [WampServer website](https://www.wampserver.com/).

### Database Configuration

1. **Start WampServer**:

   - Launch WampServer from your Start menu or desktop shortcut.

2. **Access phpMyAdmin**:

   - Open a web browser.
   - Enter the following URL to access phpMyAdmin:

     ```
     http://localhost/phpmyadmin
     ```

3. **Login to phpMyAdmin**:

   - Log in with your phpMyAdmin credentials (usually the default is root with no password). You can configure these credentials during the WampServer installation.

4. **Create a Database**:

   - Click on the "Databases" tab in phpMyAdmin.
   - In the "Create database" section, enter the name of the database:

     ```
     Database name: user_db
     ```

   - Click the "Create" button.

5. **Create Tables**:

   - Click on the newly created `user_db` database on the left panel.
   - Click the "SQL" tab at the top of the page.

   - In the SQL query box, paste the SQL commands to create the necessary tables. For your project, you'll need two tables: `user_form` and `logindetails`.

     ```sql
     -- Table for sign-up information
     CREATE TABLE user_form (
         Email VARCHAR(255),
         User VARCHAR(255) PRIMARY KEY,
         Phone_no VARCHAR(15),
         Set_Pwd VARCHAR(255),
         Confirm_Pwd VARCHAR(255)
     );

     -- Table for login information
     CREATE TABLE logindetails (
         Username VARCHAR(255) PRIMARY KEY,
         Password VARCHAR(255)
     );
     ```

   - Click the "Go" button to execute the SQL query. This will create the tables.

6. **Database Configuration in Code**:

   - Open your project's configuration files (e.g., `config.php`) where you connect to the database.
   - Update the database connection details to match your WampServer setup:

     ```php
     $db_host = 'localhost';
     $db_name = 'user_db';
     $db_user = 'root'; // Your WampServer MySQL username
     $db_pass = ''; // Your WampServer MySQL password
     ```

   Ensure that your project uses these configuration settings to connect to the `user_db` database.

### Usage

Your database is now set up, and your project should be able to interact with the `user_db` database. Users can sign up and log in using the `user_form` and `logindetails` tables.

### Troubleshooting

If you encounter any issues with database setup, please consult the WampServer documentation or seek assistance online. Make sure WampServer and its MySQL service are running. Additionally, check your project's database connection settings for accuracy.

### Contact Information

For any further assistance, please contact us.
```
Mail id: cgatreddi@gmail.com
Ph no: 9032022207
```
---
