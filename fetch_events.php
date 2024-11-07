<?php
include 'db_connection.php';

// Fetch events
$sql = "SELECT event_id, event_title, event_date, start_time, end_time FROM Events";
$result = $conn->query($sql);

$events = array();

while ($row = $result->fetch_assoc()) {
    // Format each event for FullCalendar
    $events[] = array(
        'id' => $row['event_id'],
        'title' => $row['event_title'],
        'start' => $row['event_date'] . 'T' . $row['start_time'],
        'end' => $row['event_date'] . 'T' . $row['end_time']
    );
}

// Return the event data as JSON
header('Content-Type: application/json');
echo json_encode($events);

$conn->close();
?>
