<?php
    // Start the session to maintain user login state
    session_start();

    // Disable error reporting
    error_reporting(0);

    // Check if the user is logged in; if not, redirect to the login page
    if($_SESSION['userLogin'] != 1) {
        header("location:index.php");
    }

    // Include a file to select required data (e.g., database queries)
    include "includes/all-select-data.php";

    // Fetch the voting start and end dates from the database
    $val_query = "SELECT * FROM voting";
    $val_data = mysqli_query($con, $val_query);
    $val_result = mysqli_fetch_assoc($val_data);

    // Store voting start and end dates in variables
    $vot_start_date = $val_result['vot_start_date'];
    $vot_end_date = $val_result['vot_end_date'];

    // Set the session status to indicate that the user has voted
    $_SESSION['status'] = 'voted';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadata for the webpage -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting System</title>

    <!-- Linking external CSS files for styling -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Including Chart.js for rendering charts -->
    <script src="js/chart.js"></script>

    <!-- Inline CSS for specific styling -->
    <style>
         .result-box
        {
            display: none; /* Initially hide the results */
        }
        h4.heading
        {
            color: tomato; /* Color for headings */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header section displaying the logo and user profile -->
        <div class="header">
            <span class="logo">Voting System</span>
            <!-- User profile with an image and name that triggers a profile panel when clicked -->
            <span class="profile" onclick="showProfile()">
                <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
                <label><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></label>
            </span>
        </div>

        <!-- Profile panel that appears when the profile is clicked -->
        <div id="profile-panel">
            <span class="fa-solid fa-circle-xmark" onclick="hidePanel()"></span>
            <div class="dp"><img src="<?php echo $_SESSION['idcard']; ?>" alt=""></div>
            <div class="info">
                <h2><?php echo $_SESSION['fname']." ".$_SESSION['lname']; ?></h2>
            </div>
            <div class="link">
                <!-- Logout link -->
                <a href="includes/user-logout.php" class="del">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                </a>
            </div>
        </div>

        <!-- Heading displayed after a successful vote -->
        <h2 class="heading center">Your vote Submitted Successfully!</h2>

        <!-- A heading showing that results will be available after voting ends -->
        <h4 class="heading">Result Show After Voting ends</h4>

        <!-- Container for voting results, initially hidden -->
        <div class="result-box">
            <h2 class="result-title">Voting Result</h2>
            <?php
                // Loop to dynamically generate canvases for each voting result
                $i = 0;
                while($i < $total_pos) {
                    echo '
                    <div class="result"><canvas class="myChart"></canvas></div>
                    ';
                    $i++;
                }
            ?>
        </div>
    </div>

    <!-- Including the custom JavaScript for additional functionality -->
    <script src="js/script.js"></script>
    <script>

        // Pass PHP variables to JavaScript
        var vot_start_date = "<?php echo $vot_start_date; ?>";
        var vot_end_date = "<?php echo $vot_end_date; ?>";
        console.log(vot_end_date)

        // Convert start and end dates to milliseconds for calculation
        var start_date = Date.parse(vot_start_date);
        var end_date = Date.parse(vot_end_date);

        // Get the current date in milliseconds
        var current_date = Date.parse(new Date());

        // Calculate the remaining time before voting starts and ends
        start_vot = start_date - current_date;
        end_vot = end_date - current_date;
        
        // Get the result container and heading elements
        var vresult = document.getElementsByClassName("result-box");
        var heading = document.getElementsByClassName("heading");

         // Display results after the voting starts
         setTimeout(() => {
            vresult["0"].style.display = "none";
        }, start_vot);

        // Show the results after voting ends and hide the "Result Show After Voting ends" heading
        setTimeout(() => {
            vresult["0"].style.display = "block";
            heading["1"].style.display = "none";
        }, end_vot);

        // Initialize chart for voting result visualization
        var ctx = [];
        var myChart = [];
        <?php
            // Include a PHP file to process candidate results
            include "includes/candidate_result.php";
        ?>
    </script>
</body>
</html>
