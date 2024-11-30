<?php
// Start the session to manage user-specific data across pages
session_start();

// Destroy any existing session to ensure a fresh start for the user
session_destroy();

// Disable error reporting for this script
error_reporting(0);

// Reset the user login session variable to indicate no user is currently logged in
$_SESSION['userLogin'] = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Define character encoding, browser compatibility, and responsiveness -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Set the title of the webpage -->
    <title>University Online Voting System</title>
    
    <!-- Link to the external CSS stylesheet for styling the page -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Main container for the content of the page -->
    <div class="container">
        
        <!-- Section for the heading/title of the voting system -->
        <div class="heading">
            <h1>University Online Voting System</h1>
        </div>
        
        <!-- Section containing the voter login form -->
        <div class="form">
            <h4>Voter Login</h4>
            
            <!-- Form to capture user login information and submit it to the OTP form -->
            <form action="otpform.php" method="POST">
                <!-- Input field for the user to enter their phone number -->
                <label class="label">Phone Number:</label>
                <input type="text" name="phone" id="" class="input" placeholder="Enter Phone Number" required>
                
                <!-- Submit button for the login form -->
                <button class="button" name="login">Login</button>
                
                <!-- Links for new user registration and phone number change -->
                <div class="link1">New user? <a href="registration.php">Register here</a></div>
                <div class="link1">Change Mobile Number? <a href="lost_phone.php">Send Request</a></div>
            </form>
            
            <!-- Display error messages stored in the session, if any -->
            <p class="error"><?php echo $_SESSION['error']; ?></p>
        </div>

    </div>
</body>
</html>
