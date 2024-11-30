<?php

    // Suppress error reporting for cleaner output (useful during production, but not recommended for debugging)
    error_reporting(0);

    // Start the session to store and manage user data across pages
    session_start();

    // Initialize an error message in the session to handle login feedback
    $_SESSION['error'] = "";

    // Include external file containing data selection logic (e.g., fetching necessary data)
    include "../includes/all-select-data.php";

    // Capture the email input submitted via POST request from the login form
    $email = $_POST['email'];

    // Establish a connection to the MySQL database (update credentials as needed)
    $con = mysqli_connect('localhost', 'root', '', 'voting');

    // Define the SQL query to fetch the admin record matching the submitted email
    $query = "SELECT * FROM admin WHERE email='$email'";
    $data = mysqli_query($con, $query);

    // Retrieve the query result as an associative array
    $result = mysqli_fetch_assoc($data);

    // Store fetched admin data in session variables for later use
    $_SESSION['email'] = $result['email'];
    $_SESSION['password'] = $result['password'];
    $_SESSION['name'] = $result['name'];

    // Validate the submitted email and password against the database records
    if ($_POST['email'] == $_SESSION['email'] && $_POST['password'] == $_SESSION['password']) {
        // Ensure the email and password are not null before granting access
        if ($_SESSION['email'] != null && $_SESSION['password'] != null) {
            $_SESSION['adminLogin'] = 1; // Set admin login flag to indicate successful authentication
        }
    }

    // Check if admin login flag is not set (failed login)
    if ($_SESSION['adminLogin'] != 1) {
        // Redirect back to the login page and set an error message
        header("location:index.php");
        $_SESSION['error'] = "wrong password!";
    } else {
        // Redirect to the admin panel on successful login
        header("location:admin-panel.php");
    }

?>
