<?php
session_start(); // Start a session to track the user's login state
error_reporting(0); // Disable error reporting for a cleaner output

// Check if the user is logged in as an admin. If not, redirect to the login page.
if($_SESSION['adminLogin'] != 1) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Character encoding -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Ensure compatibility with older versions of Internet Explorer -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Make the page mobile-responsive -->
    <title>University Online Voting System</title>
    <!-- Include external CSS files for styling -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <style>
        /* Custom styles for buttons and table cells */
        .del, .edit, .verify {
            display: block;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .verify {
            background-color: royalblue;
        }
        td {
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header section with the logo, user profile, and menu -->
        <div class="header">
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <span class="logo">Voting System</span>
            <!-- Display logged-in admin's name and profile image -->
            <span class="profile" onclick="showProfile()"><img src="../res/user3.jpg" alt=""><label><?php echo $_SESSION['name']; ?></label></span>
        </div>

        <!-- Include the menu from another file -->
        <?php include '../includes/menu.php'; ?>

        <!-- Profile panel that appears when clicking on the profile picture -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i> <!-- Close profile panel -->
            <div class="dp"><img src="../res/user3.jpg" alt=""></div> <!-- Display profile picture -->
            <div class="info">
                <h2><?php echo $_SESSION['name']; ?></h2> <!-- Display the admin's name -->
                <h5>Admin</h5> <!-- Display the role of the logged-in user -->
            </div>
            <!-- Logout link for the admin -->
            <div class="link"><a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div>
        </div>

        <!-- Main content section -->
        <div id="main">
            <div class="heading"><h2>Voter Requests</h2></div> <!-- Section heading -->

            <!-- Table to display voter requests for phone number changes -->
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>ID Name</th>
                    <th>ID Card</th>
                    <th>DOB</th>
                    <th>Old Phone No</th>
                    <th>New Phone No</th>
                    <th>Action</th> <!-- Action column for performing tasks like delete -->
                </thead>
                <tbody>
                    <?php
                    // Connect to the database
                    $con = mysqli_connect('localhost', 'root', '', 'voting');
                    
                    // Query to fetch all phone number change requests
                    $query = "SELECT * FROM phno_change";
                    
                    // Execute the query
                    $data = mysqli_query($con, $query);
                    
                    // Loop through each request and display the information in a table row
                    while($result = mysqli_fetch_assoc($data)) {
                        echo "<tr>
                            <td>".$result['vname']."</td>
                            <td>".$result['idname']."</td>
                            <td><a href='../$result[idcard]'><img src='../".$result['idcard']."'></a></td>
                            <td>".$result['dob']."</td>
                            <td>".$result['old_phno']."</td>
                            <td>".$result['new_phno']."</td>
                            <td><a href='voter_req_delete.php?id=$result[id]' class='del' onClick='return delconfirm()'><i class='fa-solid fa-trash-can'></i> Delete</a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include the JavaScript for interactivity -->
    <script src="../js/script.js"></script>
    <script>
        // Function to confirm deletion before proceeding
        function delconfirm() {
            return confirm('Delete this Voter?');
        }
    </script>
</body>
</html>
