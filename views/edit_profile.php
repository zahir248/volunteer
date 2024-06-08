<?php
require_once '../session/session.php';
require_once '../models/config.php'; // Include the configuration file
check_login();

// Fetch user data based on user_id from session
$user_id = $_SESSION['user_id'];
$userData = getUserData($user_id);

// Update user data if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];
    $organization_name = $_POST['organization_name'];
    $organization_description = $_POST['organization_description'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];
    $interest = $_POST['interest'];

    updateUserData($user_id, $username, $fullname, $email, $password, $user_type, $organization_name, $organization_description, $phone_number, $address, $city, $state, $country, $postal_code, $interest);

    // Refresh user data
    $userData = getUserData($user_id);

    // Display a success message in JavaScript alert and redirect to profile.php
    echo "<script>alert('Profile updated successfully!'); window.location.href = 'profile.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Organizer</title>
    <link rel="stylesheet" href="../styles/edit_profile.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome for icons -->
</head>
<body>
    <div class="form-container">
        <h1>Edit Profile</h1>
        <form action="edit_profile.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" required>
            
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $userData['fullname']; ?>" required>
            
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo $userData['password']; ?>" required>

            <!-- Hidden input field to hold the user type value -->
            <input type="hidden" id="user_type" name="user_type" value="<?php echo $userData['user_type']; ?>">

            <!-- Visible input field -->
            <label for="user_type">User Type</label>
            <input type="text" id="user_type_display" name="user_type_display" value="<?php echo $userData['user_type']; ?>" disabled>
            
            <?php if ($userData['organization_name'] !== null): ?>
                <label for="organization_name">Organization Name</label>
                <input type="text" id="organization_name" name="organization_name" value="<?php echo $userData['organization_name']; ?>" required>
            <?php endif; ?>
            
            <?php if ($userData['organization_description'] !== null): ?>
                <label for="organization_description">Organization Description</label>
                <textarea id="organization_description" name="organization_description" rows="4" required><?php echo $userData['organization_description']; ?></textarea>
            <?php endif; ?>
            
            <label for="phone_number">Phone Number</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $userData['phone_number']; ?>">
            
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $userData['address']; ?>">
            
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="<?php echo $userData['city']; ?>">
            
            <label for="state">State</label>
            <input type="text" id="state" name="state" value="<?php echo $userData['state']; ?>">
            
            <label for="country">Country</label>
            <input type="text" id="country" name="country" value="<?php echo $userData['country']; ?>">
            
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" value="<?php echo $userData['postal_code']; ?>">
            
            <label for="interest">Interest</label>
            <textarea id="interest" name="interest" rows="4"><?php echo $userData['interest']; ?></textarea>
            
            <input type="submit" value="Update Profile">
        </form>
        <a href="profile.php">Back to Profile</a>
    </div>
</body>
</html>
