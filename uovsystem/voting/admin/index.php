<?php
    // Starts the session to enable storing session variables
    session_start();
    
    // Disables error reporting (can be changed to log errors during debugging)
    error_reporting(0);
    
    // Initializes the session variable 'adminLogin' to 0 (indicating the admin is not logged in)
    $_SESSION["adminLogin"]=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Specifies the character encoding for the document -->
    <meta charset="UTF-8">
    
    <!-- Ensures proper rendering on different devices and browsers -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage that will appear on the browser tab -->
    <title>University Online Voting System</title>
    
    <!-- External CSS file for styling the webpage -->
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        /* Inline CSS for styling error messages */
        .error
        {
            color: red;  /* Sets the text color to red for errors */
            text-align: center;  /* Centers the error message */
        }
    </style>
</head>
<body>
   <div class="container">
        <!-- Heading section displaying the title of the system -->
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Form for admin login -->
        <div class="form">
            <!-- Subheading for admin login -->
            <h4>Admin Login</h4>
            
            <!-- The form action sends data to 'admin_welcome.php' when submitted -->
            <form action="admin_welcome.php" method="POST">
                
                <!-- Email input field with a placeholder -->
                <label class="label">Email Id:</label>
                <input type="email" name="email" class="input" placeholder="Enter Email id" required>

                <!-- Password input field with a placeholder -->
                <label class="label">Password:</label>
                <input type="password" name="password" class="input" placeholder="Enter Password" required>

                <!-- Login button to submit the form -->
                <button class="button" name="login">Login</button>
            </form>
            
            <!-- Display any error messages from the session if they exist -->
            <p class="error"><?php echo $_SESSION['error']; ?></p>
        </div>
   </div>
</body>
</html>
