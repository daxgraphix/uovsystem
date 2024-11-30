<?php
    // Start a new session or resume the existing one
    session_start();

    // Disable error reporting
    error_reporting(0);

    // Check if the user is not logged in, redirect to login page
    if($_SESSION['userLogin'] != 1) {
        header("location:index.php");
    }

    // Include a file to fetch all necessary data for the page
    include "includes/all-select-data.php";

    // Get the 'start' parameter from the URL
    $start = $_GET['start'];

    // Check if the user has already voted, redirect them to the 'voted' page
    if($_SESSION['voted'] == 1) {
        header("location:voted.php");
    } elseif($_SESSION['status'] == "voted") {
        header("location:voted.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic meta tags for character encoding and compatibility -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page title -->
    <title>University Online Voting System</title>

    <!-- Link to external stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Inline styling for specific elements -->
    <style>
        .table {
            margin-top: 1rem;
        }
        .button {
            width: 15rem;
            margin: auto;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Main container for the voting system -->
    <div class="container">
        <!-- Header section with the title -->
        <div class="heading"><h1>University Online Voting System</h1></div>

        <!-- Navigation bar with logo and user profile -->
        <div class="header">
            <span class="logo">Voting System</span>
            <span class="profile" onclick="showProfile()">
                <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
                <label><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></label>
            </span>
        </div>

        <!-- Profile panel for user details -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <div class="dp">
                <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
            </div>
            <div class="info">
                <h2><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h2>
            </div>
            <div class="link">
                <a href="includes/user-logout.php" class="del">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

        <!-- Main content area for the voting system -->
        <div class="main">
            <!-- Table for displaying voting options -->
            <table class="table">
                <thead>
                    <th>Vote</th>
                    <th>Voting Symbol</th>
                    <th>Candidate Name</th>
                    <th>Position</th>
                </thead>
                <tbody>
                    <!-- Form for submitting the vote -->
                    <form action="cal_vote.php" method="POST">
                        <?php
                        // Loop through each position and display its candidates
                        while($pos_result = mysqli_fetch_assoc($pos_data)) {
                            echo "<tr><td colspan='4'><h2>" . $pos_result['position_name'] . "</h2></td></tr>";
                            $query = "SELECT * FROM candidate WHERE position='$pos_result[position_name]'";
                            $data = mysqli_query($con, $query);
                            while($result = mysqli_fetch_assoc($data)) {
                                echo "
                                <tr>
                                    <td>
                                        <input type='radio' name='" . $pos_result['position_name'] . "' value='" . $result['id'] . "' class='vote' required>
                                        <label class='check'>&#10004;</label>
                                    </td>
                                    <td>
                                        <div class='symbol'>
                                            <a href='admin/" . $result['symphoto'] . "'><img src='admin/" . $result['symphoto'] . "'></a>
                                            <div class='bold'>" . $result['symbol'] . "</div>
                                        </div>
                                    </td>
                                    <td class='large-font'>" . $result['cname'] . "</td>
                                    <td class='large-font'>" . $pos_result['position_name'] . "</td>
                                </tr>";
                            }
                        }
                        ?>
                        <!-- Submit button for the voting form -->
                        <td colspan="4"><button class="button" name="vote">Vote</button></td>
                    </form>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript to automatically log out user after 5 minutes -->
    <script>
        setTimeout(() => {
            location.replace("includes/user-logout.php");
        }, 300000);
    </script>

    <!-- Link to external JavaScript file -->
    <script src="js/script.js"></script>
</body>
</html>
