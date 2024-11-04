**Event Management System (EMS) Database Schema**
------------------------------------------------

### **Database Name**
--------------------

* **Database Name:** `ems_database`

### **Table Schemas**
----------------------

#### **1. Clients Table**
-------------------------

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `client_id` | `int` | Unique Client Identifier | **PRIMARY** |
| `client_name` | `varchar(255)` | Client Name |  |
| `client_email` | `varchar(255)` | Client Email | **UNIQUE** |
| `client_phone` | `varchar(20)` | Client Phone Number |  |
| `client_address` | `text` | Client Address |  |
| `created_at` | `timestamp` | Timestamp for Client Registration | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

#### **2. Events Table**
-----------------------

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

#### **3. Bookings Table**
-------------------------

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

#### **4. Payments Table (Optional)**
--------------------------------------

| **Column Name** | **Data Type** | **Description** | **Key** |
| --- | --- | --- | --- |
| `payment_id` | `int` | Unique Payment Identifier | **PRIMARY** |
| `booking_id` | `int` | Foreign Key referencing Bookings Table | **FOREIGN** |
| `payment_method` | `varchar(100)` | Method of Payment |  |
| `payment_amount` | `decimal(10,2)` | Amount Paid |  |
| `payment_date` | `date` | Date the Payment was Made |  |
| `created_at` | `timestamp` | Timestamp for Payment Creation | **DEFAULT CURRENT_TIMESTAMP** |
| `updated_at` | `timestamp` | Timestamp for Last Update | **DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP** |

### **Indexing and Constraints**
-----------------------------

* **Primary Keys:** `client_id`, `event_id`, `booking_id`, `payment_id` (if using Payments Table)
* **Foreign Keys:**
	+ `bookings.client_id` references `clients.client_id`
	+ `bookings.event_id` references `events.event_id`
	+ `payments.booking_id` references `bookings.booking_id` (if using Payments Table)

### **SQL Export**
-----------------

For convenience, an SQL export of the schema can be found in the repository's root directory, named `ems_database.sql`. Import this into your MySQL database to replicate the schema.

### **Views**
#### **client_event_history**
* **Description**: Provides a comprehensive event history for each client.
* **Columns**:
    + `client_id`
    + `client_name`
    + `event_id`
    + `event_name`
    + `event_date`
    + `event_time`
    + `venue`
    + `booking_date`
* **Query Example**:
```sql
SELECT * FROM client_event_history
WHERE client_id = [desired_client_id];
```