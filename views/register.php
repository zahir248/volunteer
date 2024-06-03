<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../images/register.jpg'); /* Add the path to your background image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        .required::after {
            content: "*";
            color: red;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 40px;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.history.back();">
            <i>&#8592;</i> <!-- Left arrow symbol -->
        </button>
        <h2>Registration Form</h2>
        <form action="../controllers/process_registration.php" method="POST">
            <label for="username" class="required">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="fullname" class="required">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email" class="required">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password" class="required">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="user_type" class="required">User Type:</label>
            <select id="user_type" name="user_type" required>
                <option value="">Select User Type</option>
                <option value="volunteer">Volunteer</option>
                <option value="organizer">Organizer</option>
            </select>

            <label for="organization_name">Organization Name:</label>
            <input type="text" id="organization_name" name="organization_name">

            <label for="organization_description">Organization Description:</label>
            <textarea id="organization_description" name="organization_description"></textarea>

            <label for="phone_number" class="required">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="address" class="required">Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="city" class="required">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state" class="required">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="country" class="required">Country:</label>
            <input type="text" id="country" name="country" required>

            <label for="postal_code" class="required">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" required>

            <label for="interest" class="required">Interest:</label>
            <input type="text" id="interest" name="interest" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body
