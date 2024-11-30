<?php

// Retrieve user details from URL parameters using $_GET
$fn  = $_GET['fn'];  // First name
$ln  = $_GET['ln'];  // Last name
$idno = $_GET['idno'];  // ID number
$ph  = $_GET['ph'];  // Phone number
$ad  = $_GET['ad'];  // Address

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
   <div class="container">
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Form for updating user information -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h4>User Information Update</h4>
                
                <!-- Input fields to update user details, with values pre-filled from GET parameters -->
                <label class="label">Firstname:</label>
                <input type="text" name="fname" class="input" value="<?php echo $fn; ?>"> <!-- Pre-fill first name -->

                <label class="label">Lastname:</label>
                <input type="text" name="lname" class="input" value="<?php echo $ln; ?>"> <!-- Pre-fill last name -->

                <label class="label">ID No:</label>
                <input type="text" name="idnum" value="<?php echo $idno; ?>" class="input"> <!-- Pre-fill ID number -->

                <label class="label">Phone Number:</label>
                <input type="text" name="phone" class="input" value="<?php echo $ph; ?>"> <!-- Pre-fill phone number -->

                <label class="label">Address:</label>
                <input type="text" name="address" class="input" value="<?php echo $ad; ?>"> <!-- Pre-fill address -->

                <button class="button" name="update">Update</button> <!-- Submit button to update information -->
            </div>
        </form>
   </div> 

   <?php
   
    // Check if the form has been submitted
    if(isset($_POST['update']))
    {
        // Get the updated information from the form
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];  // Missing email field in the form, needs to be added
        $address = $_POST['address'];
        $idnum = $_POST['idnum'];
        $phone = $_POST['phone'];
        
        // Establish a connection to the database
        $con = mysqli_connect("localhost", "root", "", "voting");

        // Update queries to modify the user information in the database
        $query1 = "UPDATE applyforvoting SET phone='$phone' WHERE phone='$ph'"; // Update phone in the voting application table
        $query2 = "UPDATE register SET fname='$fname', lname='$lname', email='$email', idnum='$idnum', phone='$phone', address='$address' WHERE phone='$ph'"; // Update user details in the registration table

        // Execute the queries
        $data1 = mysqli_query($con, $query1);
        $data2 = mysqli_query($con, $query2);

        // If the update is successful, redirect the user
        if($data1)
        {
            header("location:voters.php"); // Redirect to voters page
        }
    }
   
   ?>
