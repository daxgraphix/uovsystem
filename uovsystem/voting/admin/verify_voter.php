<?php
// Establish a connection to the MySQL database
$con=mysqli_connect("localhost", "root", "", "voting");

// Retrieve the 'vid' parameter from the URL (GET request)
$vid=$_GET['vid'];

// Prepare the SQL query to update the 'register' table, setting 'verify' to 'yes' for the record with the matching ID
$query="UPDATE register SET verify='yes' WHERE id='$vid'";

// Execute the query and store the result in the variable '$data'
$data=mysqli_query($con, $query);

// Check if the query was successful
if($data)
{
    // If successful, go back to the previous page
    echo "<script> history.back() </script>";
}
?>
