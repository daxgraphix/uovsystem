<?php
// Start the session to track user login
session_start();
// Disable error reporting
error_reporting(0);

// Check if the user is logged in as an admin, if not, redirect to the login page
if($_SESSION['adminLogin'] != 1) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set the character encoding for the document -->
    <meta charset="UTF-8">
    <!-- Ensure the page is displayed properly on different devices -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Link to external CSS files for styling -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        /* Styling for buttons and table elements */
        .del, .edit, .verify {
            display: block;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        /* Styling for verify button */
        .verify {
            background-color: royalblue;
        }
        /* Table cell padding */
        td {
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header section with menu and profile info -->
        <div class="header">
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <span class="logo">Voting System</span>
            <span class="profile" onclick="showProfile()">
                <img src="../res/user3.jpg" alt=""><label><?php echo $_SESSION['name']; ?></label>
            </span>
        </div>
        <!-- Include the menu navigation -->
        <?php include '../includes/menu.php'; ?>
        
        <!-- Profile panel that appears when clicking the profile -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <div class="dp"><img src="../res/user3.jpg" alt=""></div>
            <div class="info">
                <h2><?php echo $_SESSION['name']; ?></h2>
                <h5>Admin</h5>
            </div>
            <div class="link">
                <!-- Logout link for the admin -->
                <a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <!-- Main section for displaying voters' information -->
        <div id="main">
            <!-- Button to add a new voter -->
            <div class="heading"><a href="../registration.php" class="add-btn" onclick="showForm()">+ Add</a><h2>Voters Information</h2></div>
            <!-- Heading for verified voters section -->
            <div class="heading"><h2 style="background:royalblue;">Verified Voters</h2></div>   
            
            <!-- Table for displaying verified voters -->
            <table class="table">
               <thead>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>ID Card</th>
                    <th>Institute ID No</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>               
               </thead>
               <tbody>
                      <?php
                      // Connect to the database
                      $con = mysqli_connect('localhost', 'root', '', 'voting');
                  
                      // Query to fetch verified voters
                      $query = "SELECT * FROM register WHERE verify='yes'";
                      $color = "red";
                  
                      // Execute the query
                      $data = mysqli_query($con, $query);
                    
                      // Loop through the result set and display each voter
                      while($result = mysqli_fetch_assoc($data)) {
                        // Determine whether to display the verify button
                        $verify = ($result['verify'] == "yes") ? "none" : "block";
                        echo "<tr>
                            <td>".$result['fname']." ".$result['lname']."</td>
                            <td><h4>".$result['idname']."</h4>".$result['idnum']."</td>
                            <td><a href='../$result[idcard]'><img src='../".$result['idcard']."'></a></td>
                            <td>".$result['inst_id']."</td>
                            <td>".$result['dob']."</td>
                            <td>".$result['gender']."</td>
                            <td>".$result['phone']."</td>
                            <td>".$result['address']."</td>
                            <td>".$result['status']."</td>
                            <td>
                                <a href='verify_voter.php?vid=$result[id]' style='display:$verify' class='del verify' onClick='return validconfirm()'><i class='fa-solid fa-check'></i> Verify</a>
                                <a href='user-update.php?fn=$result[fname]&ln=$result[lname]&idno=$result[idnum]&ph=$result[phone]&ad=$result[address]' class='edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                <a href='user-delete.php?ph=$result[phone]&file_path=$result[idcard]' class='del' onClick='return delconfirm()'><i class='fa-solid fa-trash-can'></i> Delete</a>
                            </td>
                        </tr>";
                      }
                      ?>
               </tbody>
           </table>

           <!-- Heading for non-verified voters section -->
           <div class="heading"><h2 style="background:royalblue;">Not Verified Voters</h2></div> 
           
           <!-- Table for displaying non-verified voters -->
           <table class="table">
               <thead>
                    <th>Name</th>
                    <th>Id Number</th>
                    <th>ID Card</th>
                    <th>Institute ID No</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Phone No</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>               
               </thead>
               <tbody>
                      <?php
                      // Query to fetch non-verified voters
                      $query = "SELECT * FROM register WHERE NOT verify='yes'";
                  
                      // Execute the query
                      $data = mysqli_query($con, $query);
                    
                      // Loop through the result set and display each voter
                      while($result = mysqli_fetch_assoc($data)) {
                        // Determine whether to display the verify button
                        $verify = ($result['verify'] == "yes") ? "none" : "block";
                        echo "<tr>
                            <td>".$result['fname']." ".$result['lname']."</td>
                            <td><h4>".$result['idname']."</h4>".$result['idnum']."</td>
                            <td><a href='../$result[idcard]'><img src='../".$result['idcard']."'></a></td>
                            <td>".$result['inst_id']."</td>
                            <td>".$result['dob']."</td>
                            <td>".$result['gender']."</td>
                            <td>".$result['phone']."</td>
                            <td>".$result['address']."</td>
                            <td>".$result['status']."</td>
                            <td>
                                <a href='verify_voter.php?vid=$result[id]' class='del verify' onClick='return validconfirm()' style='display: $verify;'><i class='fa-solid fa-check'></i> Verify</a>
                                <a href='user-update.php?fn=$result[fname]&ln=$result[lname]&idno=$result[idnum]&ph=$result[phone]&ad=$result[address]' class='edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                                <a href='user-delete.php?ph=$result[phone]&file_path=$result[idcard]' class='del' onClick='return delconfirm()'><i class='fa-solid fa-trash-can'></i> Delete</a>
                            </td>
                        </tr>";
                      }
                      ?>
               </tbody>
           </table>
        </div>
    </div>

    <!-- Include the script for handling menu interactions -->
    <script src="../js/script.js"></script>
    
    <script>
        // Confirm deletion of a voter
        function delconfirm() {
            return confirm('Delete this Voter?');
        }

        // Confirm validation of a voter
        function validconfirm() {
            return confirm('Validate this Voter?');
        }
    </script>
</body>
</html>
