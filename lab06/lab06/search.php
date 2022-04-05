<?php
$title = $_GET['mvname'];

$db_host = "localhost";
$db_user = "wittawas";
$db_password = "witty1234";
$db_name = "wittawas";

$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
$mysqli->set_charset("utf8");

$title  = "%".$title."%";
$sql = "SELECT *
        FROM film
        WHERE title LIKE ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $title);
$stmt->execute();
// Gets a result set from a prepared statement
$result = $stmt->get_result();

echo "Found " . $result->num_rows . ".<br/>";

while($row = $result->fetch_object()){ 
  echo "$row->title, $row->release_year <br/>";
} 





