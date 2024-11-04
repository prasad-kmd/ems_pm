**Using PHPMyAdmin (WAMP Server):**

1. **Open PHPMyAdmin**:
	* Navigate to `http://localhost/phpmyadmin` in your web browser.
	* Log in with your PHPMyAdmin credentials (default is usually `root` with no password).
2. **Select the Database**:
	* In the left-hand sidebar, click on the database that contains your `events` table (e.g., `ems_database`).
3. **Create a New Stored Procedure/Function**:
	* Click on the **SQL** tab.
	* In the query editor, paste the following code:
```sql
DELIMITER $$

CREATE FUNCTION schedule_conflict_check(
  new_event_date DATE,
  new_event_time TIME,
  new_event_duration INT,  -- in minutes
  venue_id INT
)
RETURNS BOOLEAN
BEGIN
  DECLARE conflict_exists BOOLEAN DEFAULT FALSE;

  SELECT TRUE
  INTO conflict_exists
  FROM events
  WHERE venue_id = new_event_date
    AND ( 
      (new_event_time >= event_time AND new_event_time < event_time + INTERVAL new_event_duration MINUTE)
      OR 
      (new_event_time + INTERVAL new_event_duration MINUTE > event_time AND new_event_time + INTERVAL new_event_duration MINUTE <= event_time + INTERVAL event_duration MINUTE)
      OR 
      (new_event_time <= event_time AND new_event_time + INTERVAL new_event_duration MINUTE >= event_time + INTERVAL event_duration MINUTE)
    );

  RETURN conflict_exists;
END$$

DELIMITER ;
```
**Explanation:**

* `CREATE FUNCTION schedule_conflict_check`: Creates a new function named `schedule_conflict_check`.
* **Parameters**:
	+ `new_event_date`: The date of the new event.
	+ `new_event_time`: The start time of the new event.
	+ `new_event_duration`: The duration of the new event in minutes.
	+ `venue_id`: The ID of the venue.
* **Function Body**:
	1. Declares a variable `conflict_exists` to store the result.
	2. Queries the `events` table to check for conflicts:
		* Same venue (`venue_id = new_event_date`).
		* Time overlap (using three conditions to cover all possible overlap scenarios).
	3. Returns `TRUE` if a conflict exists, `FALSE` otherwise.

**Using the `schedule_conflict_check` Function:**

To use this function, simply call it with the required parameters:
```sql
SELECT schedule_conflict_check(
  '2023-03-15',  -- new_event_date
  '10:00:00',    -- new_event_time
  120,           -- new_event_duration (2 hours in minutes)
  1              -- venue_id
) AS conflict_exists;
```
**Integrate with Your PHP Application:**

To use this function in your PHP application, you'll need to:

1. Establish a database connection using MySQLi or PDO.
2. Prepare and execute a query that calls the `schedule_conflict_check` function.
3. Fetch and evaluate the result.

Example using MySQLi:
```php
$conn = new mysqli($servername, $username, $password, $dbname);

$newEventDate = '2023-03-15';
$newEventTime = '10:00:00';
$newEventDuration = 120;
$venueId = 1;

$query = "SELECT schedule_conflict_check('$newEventDate', '$newEventTime', $newEventDuration, $venueId) AS conflict_exists";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['conflict_exists']) {
    echo "Schedule conflict detected!";
  } else {
    echo "No schedule conflict detected.";
  }
}
```
**Update your `DATABASE_SCHEMA.md` file**:

Reflect the changes in your `DATABASE_SCHEMA.md` file by adding a new section for the `schedule_conflict_check` function:
```markdown
### **Stored Procedures/Functions**
#### **schedule_conflict_check**
* **Description**: Checks for schedule conflicts between a new event and existing events at the same venue.
* **Parameters**:
	+ `new_event_date`: DATE
	+ `new_event_time`: TIME
	+ `new_event_duration`: INT (in minutes)
	+ `venue_id`: INT
* **Returns**: BOOLEAN (TRUE if conflict exists, FALSE otherwise)
```