<?php
session_start();
// Check if the admin is logged in, if not redirect to the login page.
if($_SESSION['adminLogin']!=1)
{
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Linking to the external CSS stylesheets -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.min.css">
</head>
<style>
    /* Styling for the form element, positioning it and applying background and shadow */
    .form
    {
        position: absolute;
        background: #fff;
        border-radius: 0rem;
        box-shadow: none;
        margin: 1rem;
        height: 0rem;
    }
    .add-btn
    {
        text-decoration: none;
    }
</style>
<body>
    <!-- Main container for the page -->
    <div class="container">
        <div class="header">
            <!-- Menu toggle buttons for showing and hiding the menu -->
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span>
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span>
            <!-- Logo of the voting system -->
            <span class="logo">Voting System</span>
            <!-- Profile section displaying the admin's name and profile picture -->
            <span class="profile" onclick="showProfile()">
                <img src="../res/user3.jpg" alt="">
                <label for=""><?php echo $_SESSION['name']; ?></label>
            </span>
        </div>
        
        <!-- Profile panel that shows more details when clicked -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <div class="dp"><img src="../res/user3.jpg" alt=""></div>
            <div class="info">
                <!-- Display the admin's name and role -->
                <h2><?php echo $_SESSION['name']; ?></h2>
                <h5>Admin</h5>
            </div>
            <div class="link">
                <!-- Logout link to end the admin session -->
                <a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
        </div>
        
        <!-- Include the sidebar menu -->
        <?php include '../includes/menu.php'; ?>

        <div id="main">
            <!-- Section heading with a link to add new candidates -->
            <div class="heading">
                <a href="cand-register.php" class="add-btn" onclick="showForm()">+ Add</a>
                <h2>Candidates Information</h2>
            </div>
            
            <!-- Table to display candidate details -->
            <table class="table">
                <thead>
                    <!-- Table headers -->
                    <th>Candidate Name</th>
                    <th>Candidate Symbol</th>
                    <th>Symbol Image</th>
                    <th>Position</th>
                    <th>Total Votes</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php
                // Include the file to fetch data from the database
                include "../includes/all-select-data.php";
                
                // Loop through the candidates' data and display them in the table
                while($result=mysqli_fetch_assoc($can_data))
                {
                    echo "<tr>
                        <td>".$result['cname']."</td>
                        <td>".$result['symbol']."</td>
                        <td><a href='$result[symphoto]'><img src='".$result['symphoto']."'></a></td>
                        <td>".$result['position']."</td>
                        <td>".$result['tvotes']."</td>
                        <td>
                            <!-- Edit candidate details link -->
                            <a href='cand-update.php?cn=$result[cname]&sy=$result[symbol]&ps=$result[position]' class='edit'>
                                <i class='fa-solid fa-pen-to-square'></i> Edit
                            </a>
                            <!-- Delete candidate link with a confirmation prompt -->
                            <a href='can-delete.php?id=$result[id]' class='del' onClick='return delconfirm()'>
                                <i class='fa-solid fa-trash-can'></i> Delete
                            </a>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include external script file -->
    <script src="../js/script.js"></script>
    <script>
        // Function to confirm the deletion of a candidate
        function delconfirm()
        {
            return confirm('Delete this Candidate?');
        }
    </script>
</body>
</html>
