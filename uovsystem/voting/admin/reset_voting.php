<?php

// Establish connection to the MySQL database 'voting' with username 'root' and no password
$con = mysqli_connect("localhost", "root", "", "voting");

// Query to reset the 'tvotes' field in the 'candidate' table (effectively resetting all candidate votes)
$rst_cand_query = "UPDATE candidate SET tvotes=''";
$rst_cand_data = mysqli_query($con, $rst_cand_query);

// Query to reset the 'status' field in the 'register' table to 'not voted' for all voters
$rst_voter_query = "UPDATE register SET status='not voted'";
$rst_voter_data = mysqli_query($con, $rst_voter_query);

// Check if the voter status reset query was successful
if ($rst_voter_data) {
    // If successful, display an alert and navigate the user back to the previous page
    echo "<script>
            alert('voting reseted!')
            history.back()
           </script>";
}

?>
