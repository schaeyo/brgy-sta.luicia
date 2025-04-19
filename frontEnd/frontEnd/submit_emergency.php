<?php

include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'] ?? null;
    $last_name = $_POST['last_name'];
    $name_extension = $_POST['name_extension'] ?? null;
    $report_date = $_POST['report_date'];
    $report_time = $_POST['report_time'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $type_of_emergency = $_POST['type_of_emergency'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    // Handle file upload
    $file = $_FILES['file'];
    $upload_dir = '../../uploads/';
    $file_path = null;

    if (!empty($file['name'])) {
        $file_path = $upload_dir . basename($file['name']);

        // Ensure the uploads directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            $file_path = null; // If file upload fails, set file_path to null
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO emergency_reports (
                first_name, middle_name, last_name, name_extension, report_date, report_time, 
                phone_number, email, file_path, type_of_emergency, location, description
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param(
        "ssssssssssss",
        $first_name, $middle_name, $last_name, $name_extension, $report_date, $report_time,
        $phone_number, $email, $file_path, $type_of_emergency, $location, $description
    );

    if ($stmt->execute()) {
        // Redirect back to the form with a success message
        header("Location: frontEnd/resident/reportEmergency.php");
        exit();
    } else {
        // Redirect back to the form with an error message
        header("Location: frontEnd/resident/reportEmergency.php");
        exit();
    }


 
}
?>