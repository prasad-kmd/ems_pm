**Event Management System (EMS)**
=====================================
# _What's the Purpose of this Project?_
**This Repository is used to provide some space for my academic projects. Specially used for Mini Project | EEX3417 | OUSL**

**Local Deployment using WAMP Server**
--------------------------------------

### **Project Overview**
------------------------

* **Brief Description**: Event Management System (EMS) streamlines scheduling, client bookings, and event tracking for efficient operations.
* **Problem Statement**: Manual event management is time-consuming, prone to errors, and lacks real-time tracking.
* **Solution Statement**: EMS provides a user-friendly platform for scheduling, booking, and real-time event management.

### **Getting Started with WAMP Server**
-----------------------------------------

#### **Prerequisites**
* **WAMP Server**: Installed and running on your local machine
* **PHP Version**: 7.4+ (ensure WAMP is configured to use this version)
* **MySQL**: Utilizing the MySQL service bundled with WAMP

#### **Setup Instructions for Local Deployment**
1. **Clone the Repository**:
	* Open Command Prompt/Powershell
	* Navigate to your WAMP `www` directory (typically `C:\wamp64\www`)
	* Run `git clone https://github.com/prasad-kmd/ems_pm event-management-system`
2. **Database Setup**:
	* Open `phpMyAdmin` via WAMP (usually `http://localhost/phpmyadmin`)
	* Create a new database (e.g., `ems_database`)
	* Import the provided `ems_database.sql` file (found in the repository's root directory) into your newly created database [TODO]
3. **Configure Database Connection**:
	* Navigate to `event-management-system/config`
	* Open `database.php` and update the database credentials to match your setup:
		+ `$db_host = 'localhost';`
		+ `$db_username = 'your_mysql_username';`
		+ `$db_password = 'your_mysql_password';`
		+ `$db_name = 'ems_database';`
4. **Start Your Local Server**:
	* Ensure WAMP Server is running
	* Access your application via `http://localhost/event-management-system`

### **System Requirements for Local Environment**
------------------------------------------------

* **Operating System**: Windows (compatible with WAMP Server)
* **WAMP Server**: Latest version (ensure PHP 7.4+ and MySQL are utilized)
* **Browser**: Any modern web browser for testing

### **Database Schema**
-----------------------

* Refer to the provided `DATABASE_SCHEMA.md` for detailed database structure
* **Key Tables**:
	+ `clients`
	+ `events`
	+ `bookings`
	+ `payments` (if implemented)

### **Usage Examples**
----------------------

* **Booking an Event**:
	1. Register/Login at `http://localhost/event-management-system`
	2. Navigate to `events` section
	3. Select an Event and Book
	4. Fill in the Booking Form

### **Troubleshooting Tips for WAMP**
---------------------------------------

* **PHP Error Logs**: Check WAMP's PHP error log for detailed error messages
* **MySQL Issues**: Verify database credentials and ensure the MySQL service is running

### **Contributing**
------------------

* **Step 1**: Fork the repository
* **Step 2**: Create a new branch for your feature
* **Step 3**: Submit a pull request with your changes

### **License**
------------

* **MIT License**: This project is licensed under the MIT License.
* **Copyright**: Prasad Madhuranga 2024. All rights reserved.

### **Authors & Acknowledgments**
---------------------------------

* **Prasad Madhuranga**: Initial Work
* **Internet**: Thanks for their support.

**Example Use Case for Local Deployment:**

* Open your web browser and navigate to `http://localhost/event-management-system`
* Explore the application, and use the provided credentials (if any) for testing purposes.