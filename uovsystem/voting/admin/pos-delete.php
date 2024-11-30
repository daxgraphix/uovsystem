<?php
// Get the 'id' parameter from the URL
$id = $_GET['id'];

// Establish a connection to the MySQL database
$con = mysqli_connect('localhost', 'root', '', 'voting');

// Create the SQL query to delete a record from the 'can_position' table where the id matches
$query = "DELETE FROM can_position WHERE id='$id'";

// Execute the query on the database
$data = mysqli_query($con, $query);

// Check if the query was successful
if ($data) {
    // If the query is successful, show an alert and navigate back to the previous page
    echo "
        <script>
            alert('Position deleted!');
            history.back(); // This goes back to the previous page
        </script>
    ";
}
?>
