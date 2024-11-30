<?php

    // Get the 'id' parameter from the URL query string
    $id = $_GET['id'];

    // Establish a connection to the MySQL database
    $con = mysqli_connect('localhost', 'root', '', 'voting');

    // Check if the connection was successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Construct the SQL DELETE query to remove the record with the specified 'id'
    $query = "DELETE FROM phno_change WHERE id='$id'";

    // Execute the query on the database
    $data = mysqli_query($con, $query);

    // If the query was successful, go back to the previous page (using JavaScript)
    if ($data) {
        echo "<script> history.back()</script>";
    }

    // Close the database connection (optional but recommended)
    mysqli_close($con);
?>
