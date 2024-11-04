Based on the provided scenario for the event management system, here is a proposed database structure including table contents, table keys, and their respective data types. This design will utilize MySQL as the database management system, with the understanding that the front-end will be built using HTML and the back-end using PHP.

### Tables and Their Structures

#### 1. **Clients Table**

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `client_id` | `int` | Unique Client Identifier | **PRIMARY** |
| `client_name` | `varchar(255)` | Client Name |  |
| `client_email` | `varchar(255)` | Client Email | **UNIQUE** |
| `client_phone` | `varchar(20)` | Client Phone Number |  |
| `client_address` | `text` | Client Address |  |
| `created_at` | `timestamp` | Timestamp for Client Registration | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

#### 2. **Events Table**

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `event_id` | `int` | Unique Event Identifier | **PRIMARY** |
| `event_title` | `varchar(255)` | Event Title |  |
| `event_description` | `text` | Event Description |  |
| `event_date` | `date` | Date of the Event |  |
| `start_time` | `time` | Start Time of the Event |  |
| `end_time` | `time` | End Time of the Event |  |
| `event_venue` | `varchar(255)` | Event Venue |  |
| `recurring` | `boolean` | Indicates if the event is recurring |  |
| `event_capacity` | `int` | Maximum Event Capacity |  |
| `created_at` | `timestamp` | Timestamp for Event Creation | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

#### 3. **Bookings Table**

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `booking_id` | `int` | Unique Booking Identifier | **PRIMARY** |
| `client_id` | `int` | Foreign Key referencing Clients Table | **FOREIGN** |
| `event_id` | `int` | Foreign Key referencing Events Table | **FOREIGN** |
| `booking_date` | `date` | Date the Booking was Made |  |
| `num_guests` | `int` | Number of Guests for the Booking |  |
| `booking_status` | `enum('Pending', 'Confirmed', 'Cancelled')` | Status of the Booking |  |
| `created_at` | `timestamp` | Timestamp for Booking Creation | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

#### 4. **Payments Table (Optional but Recommended for Completeness)**

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `payment_id` | `int` | Unique Payment Identifier | **PRIMARY** |
| `booking_id` | `int` | Foreign Key referencing Bookings Table | **FOREIGN** |
| `payment_method` | `varchar(100)` | Method of Payment (e.g., Cash, Card, etc.) |  |
| `payment_amount` | `decimal(10,2)` | Amount Paid |  |
| `payment_date` | `date` | Date the Payment was Made |  |
| `created_at` | `timestamp` | Timestamp for Payment Creation | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

### Key Explanations

- **PRIMARY**: The primary key of a table, uniquely identifying each record.
- **UNIQUE**: Ensures all values in this column are unique (e.g., email addresses).
- **FOREIGN**: Links the table to another table's **PRIMARY** key, establishing relationships between tables.
- **DEFAULT CURRENT_TIMESTAMP** and **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP**: Automatically set or update the timestamp when a record is inserted or updated, respectively.

### SQL to Create These Tables

Below is a simplified SQL script to create these tables. Note that indexes on frequently queried columns (not just primary keys) can significantly improve performance, but for brevity, they are not included here.

```sql
CREATE DATABASE event_management;

USE event_management;

CREATE TABLE Clients (
    client_id INT AUTO_INCREMENT,
    client_name VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) UNIQUE NOT NULL,
    client_phone VARCHAR(20),
    client_address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (client_id)
) ENGINE=INNODB;

CREATE TABLE Events (
    event_id INT AUTO_INCREMENT,
    event_title VARCHAR(255) NOT NULL,
    event_description TEXT,
    event_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    event_venue VARCHAR(255) NOT NULL,
    event_capacity INT,
    event_type ENUM('Conferences','Seminars','Sports Events','Weddings','Birthday Parties','Webinars','Training Sessions / Workshops','Product Launches','Trade Shows / Exhibitions','Non-profit / Fundraising Events','Art and Cultural Events','Festivals','Fairs / Carnivals','VIP Events') NOT NULL DEFAULT 'VIP Events',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (event_id)
) ENGINE=INNODB;

CREATE TABLE Bookings (
    booking_id INT AUTO_INCREMENT,
    client_id INT NOT NULL,
    event_id INT NOT NULL,
    booking_date DATE NOT NULL,
    num_guests INT NOT NULL,
    booking_status ENUM('Pending', 'Confirmed', 'Cancelled') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (booking_id),
    FOREIGN KEY (client_id) REFERENCES Clients(client_id),
    FOREIGN KEY (event_id) REFERENCES Events(event_id)
) ENGINE=INNODB;

CREATE TABLE Payments (
    payment_id INT AUTO_INCREMENT,
    booking_id INT NOT NULL,
    payment_method VARCHAR(100) NOT NULL,
    payment_amount DECIMAL(10,2) NOT NULL,
    payment_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (payment_id),
    FOREIGN KEY (booking_id) REFERENCES Bookings(booking_id)
) ENGINE=INNODB;
```
### Setting up Database
 ! By setting up database engine with InnoDB can resolve some errors with ```VARCHAR``` .
 ! By using ```ALTER TABLE my_table ENGINE = InnoDB;``` SQL Command, can convert engine into InnDB.


### Next Steps

1. **Populate Sample Data**: Insert sample data into each table to test relationships and queries.
2. **PHP Backend Development**: Create PHP scripts to interact with the database (e.g., CRUD operations).
3. **HTML Frontend Development**: Design the user interface using HTML, integrating with PHP for dynamic content.
4. **Security Measures**: Implement security practices (e.g., prepared statements, input validation) to protect against SQL injection and other vulnerabilities.



## Subject   : EEX3417
## Institute : The Open University of Sri Lanka
## Designed by Prasad Madhuranga
## Purpose   : Mini Project