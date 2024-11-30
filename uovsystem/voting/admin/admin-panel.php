<?php

    // Disable error reporting
    error_reporting(0);
    // Start the session for maintaining session variables across pages
    session_start();
    // Include necessary data (e.g., database connection and queries)
    include "../includes/all-select-data.php";

    // Check if the user is logged in as an admin, otherwise redirect to the login page
    if($_SESSION['adminLogin']!=1)
    {
        header("location:index.php");
    }

    // Query to fetch voters who have already voted
    $voter_voted_query="SELECT * FROM register WHERE status='voted'";
    $voter_voted_data=mysqli_query($con,$voter_voted_query);
    
    // Get the count of voters who have voted
    $voter_voted=mysqli_num_rows($voter_voted_data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Link to the main stylesheet -->
    <link rel="stylesheet" href="../css/all.min.css"> <!-- Link to FontAwesome for icons -->
    <script src="../js/chart.js"></script> <!-- Chart.js library for displaying charts -->
</head>
<body>
    <div class="container">
        <!-- Header section with menu and profile -->
        <div class="header">
            <span class="menu-bar" id="show" onclick="showMenu()">&#9776;</span> <!-- Menu button (show) -->
            <span class="menu-bar" id="hide" onclick="hideMenu()">&#9776;</span> <!-- Menu button (hide) -->
            <span class="logo">Voting System</span> <!-- Logo text -->
            <span class="profile" onclick="showProfile()">
                <img src="../res/user3.jpg" alt=""> <!-- Admin profile picture -->
                <label><?php echo $_SESSION['name']; ?></label> <!-- Display admin name -->
            </span>
        </div>

        <!-- Include the menu (for navigation) from another file -->
        <?php include '../includes/menu.php'; ?>

        <!-- Profile panel for showing admin details and logout link -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i> <!-- Close icon for profile panel -->
            <div class="dp"><img src="../res/user3.jpg" alt=""></div> <!-- Admin profile image -->
            <div class="info">
                <h2><?php echo $_SESSION['name']; ?></h2> <!-- Admin name -->
                <h5>Admin</h5> <!-- Admin role -->
            </div>
            <div class="link"><a href="../includes/admin-logout.php" class="del"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></div> <!-- Logout link -->
        </div>

        <!-- Main content area -->
        <div id="main">
            <!-- Info boxes displaying various data such as total voters, candidates, positions, etc. -->
            <div class="info-box" id="box1">
                <h1><?php echo $_SESSION["total_voters"]; ?></h1> <!-- Display total voters -->
                <h3>Total Voters</h3>
                <a href="voters.php">More Info <i class="fa-solid fa-circle-arrow-right"></i></a> <!-- Link to voters page -->
            </div>
            <div class="info-box" id="box2">
                <h1><?php echo $_SESSION["total_cand"]; ?></h1> <!-- Display total candidates -->
                <h3>Candidates</h3>
                <a href="candidates.php">More Info <i class="fa-solid fa-circle-arrow-right"></i></a> <!-- Link to candidates page -->
            </div>
            <div class="info-box" id="box3">
                <h1><?php echo $_SESSION["total_position"]; ?></h1> <!-- Display total positions -->
                <h3>No Of Position</h3>
                <a href="position.php">More Info <i class="fa-solid fa-circle-arrow-right"></i></a> <!-- Link to positions page -->
            </div>
            <div class="info-box" id="box4">
                <h1><?php echo $voter_voted; ?></h1> <!-- Display number of voters who have voted -->
                <h3>Voters Voted</h3>
                <a href="#">More Info <i class="fa-solid fa-circle-arrow-right"></i></a> <!-- Link to more info (currently disabled) -->
            </div>

            <!-- Result box section showing voting tally charts -->
            <div class="result-box">
                <h2 class="result-title">Voting Tally</h2> <!-- Title for voting tally -->
                <?php
                    // Loop to generate result charts for each position
                    $i=0;
                    while($i<$total_pos)
                    {
                        echo '
                        <div class="result"><canvas class="myChart"></canvas></div>
                        ';
                        $i++;
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling chart data and interactions -->
    <script>
        var ctx = [];
        var myChart = [];
        <?php
            // Include candidate result data to populate charts
            include "../includes/candidate_result.php";
        ?>
    </script>

    <!-- Include main script for additional functionalities -->
    <script src="../js/script.js"></script>
</body>
</html>
