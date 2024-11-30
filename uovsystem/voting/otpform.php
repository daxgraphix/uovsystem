<?php

// Disable error reporting to prevent display of sensitive information
error_reporting(0);

// Start a session to manage user data across pages
session_start();

// Establish a connection to the database
$con = mysqli_connect("localhost", "root", "", "voting");

// Retrieve the phone number submitted via the POST method
$phone = $_POST['phone'];

// Check if the user is not logged in (i.e., no phone number in session)
// If not, include the login script for voter authentication
if ($_SESSION['phone'] == null) {
    include "includes/voter_login_data.php";
}

// Display the OTP stored in the session (used for debugging or testing)
// Note: This should not be displayed in a production environment
echo $_SESSION['otp'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic meta tags for compatibility and responsive design -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Linking external stylesheet for page styling -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
        /* Inline CSS to hide the resend OTP link by default */
        #resend {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Page heading for the voting system -->
        <div class="heading">
            <h1>University Online Voting System</h1>
        </div>

        <!-- OTP verification form -->
        <div class="form">
            <h4>OTP Verification</h4>
            <form action="voting-system.php" method="POST">
                <!-- Input field for OTP -->
                <label class="label">OTP:</label>
                <input type="name" name="otp" class="input" placeholder="Enter OTP" required>
                
                <!-- Submit button to verify OTP -->
                <button class="button">Verify</button>
                
                <!-- Timer display and Resend OTP link -->
                <center>
                    <div class="timer"></div>
                    <?php 
                    // Resend OTP link dynamically generates a URL with the phone number from the session
                    echo "<a id='resend' href='includes/resend_otp.php?phone=$_SESSION[phone]'>Resend OTP</a>"; 
                    ?>
                </center>
                
                <!-- Display error message if OTP verification fails -->
                <p class="error"><?php echo $_SESSION['error']; ?></p>
            </form>
        </div>
    </div>

    <!-- JavaScript to manage the timer and display resend OTP link -->
    <script type="text/javascript">
        var timer = document.getElementsByClassName("timer");
        var link = document.getElementById("resend");
        sec = 30; // Initialize timer with 30 seconds
        setInterval(() => {
            // Update timer display
            timer["0"].innerHTML = "00:" + sec;
            sec--;
            if (sec < 0) {
                // Hide timer and show resend OTP link after countdown ends
                timer["0"].style.display = "none";
                link.style.display = "block";
            }
        }, 1000);
    </script>
</body>

</html>
