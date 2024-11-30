<?php

    // Retrieve phone number and file path from the URL query parameters
    $phone = $_GET['ph'];  // Phone number passed via URL
    $file_path = $_GET['file_path'];  // File path of the file to be deleted

    // Delete the file from the server
    unlink("../" . $file_path);  // Removes the file from the server (going up one directory from the current location)

    // Connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'voting');  // Establishing a connection to the MySQL database

    // Prepare the SQL query to delete a user from the 'register' table based on phone number
    $query = "DELETE FROM register WHERE phone='$phone'";  // SQL query to delete user with matching phone number
    $data = mysqli_query($con, $query);  // Execute the query

    // Check if the deletion was successful and navigate back
    if($data) {
        echo "<script> history.back()</script>";  // If successful, go back to the previous page
    }

?>
