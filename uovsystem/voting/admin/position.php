<?php
// Start a session to track user login status
session_start();

// Check if the user is an admin (i.e., 'adminLogin' is set to 1)
// If not, redirect the user to the login page (index.php)
if($_SESSION['adminLogin']!=1)
{
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Define character encoding for the page -->
    <meta charset="UTF-8">
    <!-- Ensure the page is compatible with modern browsers -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Set viewport for responsive design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Include external CSS for styling -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Include FontAwesome icons for UI elements -->
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        /* Style the table rows to have consistent height */
       .table td
       {
           height: 2rem;
       }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header section with navigation and profile info -->
        <div class="header">
            <!-- Menu icon for showing the menu -->
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <!-- Menu icon for hiding the menu -->
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <!-- Voting system logo -->
            <span class="logo">Voting System</span>
            <!-- Profile section with admin's name and photo, triggers profile view -->
            <span class="profile" onclick="showProfile()"><img src="../res/user3.jpg" alt=""><label for=""><?php echo $_SESSION['name']; ?></label></span>
        </div>
        
        <!-- Profile panel displaying admin details and logout option -->
        <div id="profile-panel">
            <!-- Close profile panel icon -->
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <!-- Display admin's profile picture -->
            <div class="dp"><img src="../res/user3.jpg" alt=""></div>
            <!-- Display admin's name and role -->
            <div class="info">
                <h2><?php echo $_SESSION['name']; ?></h2>
                <h5>Admin</h5>
            </div>
            <!-- Logout link for admin -->
            <div class="link"><a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
        </div>
        
        <!-- Include the navigation menu from an external file -->
        <?php include '../includes/menu.php'; ?>
        
        <div id="main">
            <!-- Heading section with an 'Add' button to add new positions -->
            <div class="heading">
                <a href="add_position.php" class="add-btn" onclick="showForm()">+ Add</a>
                <h2>Positions</h2>
            </div>
            
            <!-- Table displaying the list of positions -->
           <table class="table">
               <thead>
                   <th>Position</th>
                   <th>Action</th>
               </thead>
               <tbody>
               <?php
                      // Include the script to fetch position data from the database
                      include "../includes/all-select-data.php";
                    
                      // Loop through each position and display it in the table
                      while($result=mysqli_fetch_assoc($pos_data))
                      {
                        echo "<tr>
                        <td>".$result['position_name']."</td>
                        <td><a href='pos_update.php?psnm=$result[position_name]&id=$result[id]' class='edit'><i class='fa-solid fa-pen-to-square'></i> Edit</a>
                        <a href='pos-delete.php?id=$result[id]' class='del' onClick='return delconfirm()'><i class='fa-solid fa-trash-can'></i> Delete</a></td>
                        </tr>";
                      }
               ?>
               </tbody>
           </table>
        </div>
    </div>

    <!-- Include external JavaScript file for additional functionality -->
    <script src="../js/script.js"></script>

    <script>
        // Confirmation prompt before deleting a position
        function delconfirm()
        {
            return confirm('Delete this Position?');
        }
    </script>
</body>
</html>
