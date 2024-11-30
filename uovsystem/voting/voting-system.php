<?php
// Disable error reporting for a cleaner user experience
error_reporting(0);
// Start a session to manage user state and data
session_start();

// Include a file to fetch all necessary data from the database
include "includes/all-select-data.php";

// Handle OTP (One-Time Password) validation
$otp = $_POST['otp'];
if ((int)$_SESSION['otp'] == (int)$otp) // Check if the provided OTP matches the session OTP
{
    // Mark the user as logged in
    $_SESSION['userLogin'] = 1;

    // Redirect users to the "voted" page if they have already voted
    if ($_SESSION['voted'] == 1) 
    {
        header("location:voted.php");
    } 
    else if ($_SESSION['status'] == "voted") 
    {
        header("location:voted.php");
    }
} 
else 
{
    // Handle invalid OTP by redirecting back to the OTP form with an error message
    $_SESSION['error'] = "Wrong OTP Entered";
    header("location:otpform.php");
}

// Connect to the database
$con = mysqli_connect("localhost", "root", "", "voting");

// Fetch voting details from the database
$val_query = "SELECT * FROM voting";
$val_data = mysqli_query($con, $val_query);
$val_result = mysqli_fetch_assoc($val_data);

// Extract voting details
$voting_title = $val_result['voting_title'];
$vot_start_date = $val_result['vot_start_date'];
$vot_end_date = $val_result['vot_end_date'];

// Redirect users to the login page if the phone session variable is not set
if ($_SESSION['phone'] == null) {
    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <!-- Include CSS stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Include JavaScript library for charts -->
    <script src="js/chart.js"></script>
    <style>
        /* Define the default styles for elements */
        .box {
            display: none;
        }
        .warning {
            color: tomato;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header section with logo and user profile -->
        <div class="header">
            <span class="logo">Voting System</span>
            <span class="profile" onclick="showProfile()">
                <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
                <label><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></label>
            </span>
        </div>

        <!-- User profile panel -->
        <div id="profile-panel">
            <i class="fa-solid fa-circle-xmark" onclick="hidePanel()"></i>
            <div class="dp"><img src="<?php echo $_SESSION['idcard']; ?>" alt=""></div>
            <div class="info">
                <h2><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h2>
            </div>
            <div class="link">
                <a href="includes/user-logout.php" class="del">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

        <!-- Main content area -->
        <div class="main">
            <h1 class="heading">Welcome <?php echo $_SESSION['fname']; ?>!</h1>
            <h2 class="warning">Voting will start soon...</h2>

            <!-- Voting details box -->
            <div class="box">
                <h4 class="heading">Start Voting</h4>
                <table>
                    <tr>
                        <td class="bold">Voting Title :</td>
                        <td><?php echo $voting_title; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">Voting Start :</td>
                        <td><?php echo $vot_start_date; ?></td>
                    </tr>
                    <tr>
                        <td class="bold">Voting End :</td>
                        <td><?php echo $vot_end_date; ?></td>
                    </tr>
                </table>
                <div class="link1"><a href="ballet.php?start=1">Start</a></div>
            </div>
        </div>
    </div>

    <!-- Include external JavaScript files -->
    <script src="js/script.js"></script>
    <script>
        // Auto-logout user after 5 minutes of inactivity
        setTimeout(() => {
            location.replace("includes/user-logout.php");
        }, 300000);

        // Pass PHP variables to JavaScript
        var vot_start_date = "<?php echo $vot_start_date; ?>";
        var vot_end_date = "<?php echo $vot_end_date; ?>";

        // Convert dates to milliseconds
        var start_date = Date.parse(vot_start_date);
        var end_date = Date.parse(vot_end_date);
        var current_date = Date.parse(new Date());

        // Calculate time differences for voting
        var start_vot = start_date - current_date;
        var end_vot = end_date - current_date;

        // DOM elements for voting
        var box = document.getElementsByClassName("box");
        var warning = document.getElementsByClassName("warning");

        // Display voting box when voting starts
        setTimeout(() => {
            box[0].style.display = "block";
            warning[0].style.display = "none";
        }, start_vot);

        // Hide voting box when voting ends
        setTimeout(() => {
            box[0].style.display = "none";
            warning[0].style.display = "block";
            warning[0].innerHTML = "No voting available!";
        }, end_vot);
    </script>
</body>

</html>
