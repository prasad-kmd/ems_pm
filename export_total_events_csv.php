<?php
include 'db_connection.php';

// Fetch event data
$sql = "SELECT event_title, event_date, start_time, end_time, event_venue, event_type FROM Events ORDER BY event_date ASC";
$result = $conn->query($sql);

// Set headers for download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=total_events_report.csv');

// Open output stream
$output = fopen("php://output", "w");

// Add the column headers
fputcsv($output, array('Event Title', 'Event Date', 'Start Time', 'End Time', 'Venue', 'Event Type'));

// Output each row of data as a CSV line
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

// Close output stream and database connection
fclose($output);
$conn->close();
exit();
