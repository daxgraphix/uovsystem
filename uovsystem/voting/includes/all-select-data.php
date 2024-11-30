<?php
// Disable error reporting for better user experience
error_reporting(0);

// Establishing connection to the MySQL database with the provided credentials
$con = mysqli_connect("localhost","root","","voting");

// Fetching data about candidates
$can_query = "SELECT * FROM candidate"; // SQL query to retrieve all candidates
$can_data = mysqli_query($con, $can_query); // Executing the query and storing the result
$_SESSION["total_cand"] = mysqli_num_rows($can_data); // Storing the total number of candidates in session
$total_cand = mysqli_num_rows($can_data); // Storing the total number of candidates in a variable

// Fetching data about registered voters
$voter_query = "SELECT * FROM register"; // SQL query to retrieve all registered voters
$voter_data = mysqli_query($con, $voter_query); // Executing the query and storing the result
$_SESSION["total_voters"] = mysqli_num_rows($voter_data); // Storing the total number of voters in session

// Fetching data about candidate positions
$pos_query = "SELECT * FROM can_position"; // SQL query to retrieve all candidate positions
$pos_data = mysqli_query($con, $pos_query); // Executing the query and storing the result
$_SESSION["total_position"] = mysqli_num_rows($pos_data); // Storing the total number of positions in session
$total_pos = mysqli_num_rows($pos_data); // Storing the total number of positions in a variable

?>
