<?php
// Database connection variables
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'volunteer');

// Create connection
function db_connect() {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function getUserData($user_id) {
    // Create connection
    $conn = db_connect();

    // Fetch user data
    $stmt = $conn->prepare("SELECT username, fullname, email, password, user_type, organization_name, organization_description, phone_number, address, city, state, country, postal_code, interest FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username, $fullname, $email, $password, $user_type, $organization_name, $organization_description, $phone_number, $address, $city, $state, $country, $postal_code, $interest);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    // Return user data as an array
    return [
        'username' => $username,
        'fullname' => $fullname,
        'email' => $email,
        'password' => $password,
        'user_type' => $user_type,
        'organization_name' => $organization_name,
        'organization_description' => $organization_description,
        'phone_number' => $phone_number,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'country' => $country,
        'postal_code' => $postal_code,
        'interest' => $interest
    ];
}

function updateUserData($user_id, $username, $fullname, $email, $password, $user_type, $organization_name, $organization_description, $phone_number, $address, $city, $state, $country, $postal_code, $interest) {
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE user SET username = ?, fullname = ?, email = ?, password = ?, user_type = ?, organization_name = ?, organization_description = ?, phone_number = ?, address = ?, city = ?, state = ?, country = ?, postal_code = ?, interest = ? WHERE user_id = ?");
    $stmt->bind_param("ssssssssssssssi", $username, $fullname, $email, $password, $user_type, $organization_name, $organization_description, $phone_number, $address, $city, $state, $country, $postal_code, $interest, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
