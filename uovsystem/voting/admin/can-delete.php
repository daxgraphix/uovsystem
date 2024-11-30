<?php
// Retrieve the 'id' parameter from the URL's query string
$id = $_GET['id'];  // Get the 'id' of the candidate to delete

// Establish a connection to the MySQL database using mysqli
$con = mysqli_connect('localhost', 'root', '', 'voting');  // Connect to the database

// Construct the SQL query to delete the candidate record based on the provided id
$query = "DELETE FROM candidate WHERE id='$id'";  // Delete the candidate from the 'candidate' table where id matches

// Execute the query on the database
$data = mysqli_query($con, $query);  // Run the SQL query

// Check if the deletion was successful
if ($data) {
    // If the deletion is successful, show an alert message and go back to the previous page
    echo "<script>
            alert('candidate deleted!')  // Display an alert saying candidate deleted
            history.back()  // Go back to the previous page
         </script>";
}
?>
