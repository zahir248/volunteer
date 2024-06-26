<?php
require_once '../models/config.php'; // Include the configuration file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $user_type = $_POST["user_type"];
    $organization_name = isset($_POST["organization_name"]) ? $_POST["organization_name"] : "";
    $organization_description = isset($_POST["organization_description"]) ? $_POST["organization_description"] : "";
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $country = $_POST["country"];
    $postal_code = $_POST["postal_code"];
    $interest = $_POST["interest"];

    // Connect to MySQL database
    $conn = db_connect();

    // Check if the email already exists
    $check_email_stmt = $conn->prepare("SELECT email FROM user WHERE email = ?");
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();

    if ($check_email_stmt->num_rows > 0) {
        // Email already exists, show an error message
        echo "<script>alert('This email is already registered. Please use a different email.'); window.history.back();</script>";
        exit(); // Terminate the script
    }

    // Close the email check statement
    $check_email_stmt->close();

    // Prepare SQL statement for inserting new user
    $stmt = $conn->prepare("INSERT INTO user (username, fullname, email, password, user_type, organization_name, organization_description, phone_number, address, city, state, country, postal_code, interest) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $username, $fullname, $email, $password, $user_type, $organization_name, $organization_description, $phone_number, $address, $city, $state, $country, $postal_code, $interest);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Redirect to index.php after successful registration
        echo "<script>alert('Registration Successful!'); window.location.href = '../views/index.php';</script>";
        exit(); // Terminate the script after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the registration page
    header("Location: registration.php");
    exit();
}
?>
