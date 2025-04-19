<?php
include 'db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'] ?? null;
    $last_name = $_POST['last_name'];
    $name_extension = $_POST['name_extension'] ?? null;
    $feedback_date = $_POST['feedback_date'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $citizenship = $_POST['citizenship'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    // Validate the rating against ENUM values
    $valid_ratings = [
        '5 Very Satisfied',
        '4 Satisfied',
        '3 Neutral',
        '2 Dissatisfied',
        '1 Very Dissatisfied'
    ];

    if (!in_array($rating, $valid_ratings)) {
        header("Location: ../../resident/submitFeedback.php?error=Invalid rating value.");
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO feedback (
                first_name, middle_name, last_name, name_extension, feedback_date, 
                phone_number, email, citizenship, rating, comment
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $con->prepare($sql);
    $stmt->bind_param(
        "ssssssssss",
        $first_name, $middle_name, $last_name, $name_extension, $feedback_date,
        $phone_number, $email, $citizenship, $rating, $comment
    );

    if ($stmt->execute()) {
        // Redirect back to the form with a success message
        header("Location: ../../resident/submitFeedback.php?success=1");
        exit();
    } else {
        // Redirect back to the form with an error message
        header("Location: ../../resident/submitFeedback.php?error=Database error.");
        exit();
    }
}
?>