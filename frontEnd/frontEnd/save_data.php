<?php
include 'db_connection.php'; 
session_start();


$male = $_POST['male'];
$female = $_POST['female'];
$occupied = $_POST['occupied'];
$vacant = $_POST['vacant'];

$sql = "INSERT INTO analytics_data (male_population, female_population, occupied_residential, vacant_residential)
        VALUES (?, ?, ?, ?)";

$stmt = $con->prepare($sql);
$stmt->bind_param("iiii", $male, $female, $occupied, $vacant);

if ($stmt->execute()) {
  echo "Data saved successfully!";
} else {
  echo "Error: " . $stmt->error;
}

?>