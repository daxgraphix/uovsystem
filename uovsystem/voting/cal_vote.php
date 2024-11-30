<?php

    // Disable error reporting
    error_reporting(0);

    // Start a new session or resume the existing one
    session_start();

    // Check if the user is logged in; redirect to the login page if not
    if($_SESSION['userLogin'] != 1) {
        header("location:index.php");
    }
    // Check if the user has already voted; redirect to the 'voted' page if true
    elseif($_SESSION['status'] == "voted") {
        header("location:voted.php");
    }

    // Include a file to fetch all necessary data
    include "includes/all-select-data.php";

    // Initialize a counter for iterating through positions
    $i = 0;

    // Loop through the positions and process votes for each position
    while($pos_result = mysqli_fetch_assoc($pos_data)) {
        // Get the position name
        $pos_name = $pos_result['position_name'];

        // Retrieve the candidate ID based on the position
        $can_id[] = $_POST[$pos_name];
        $id = $can_id[$i];

        // Fetch candidate details from the database using their ID
        $can_sel_query = "select * from candidate where id='$id'";
        $can_sel_data = mysqli_query($con, $can_sel_query);
        $can_sel_res = mysqli_fetch_assoc($can_sel_data);

        // Update the candidate's vote count
        $prev_votes = $can_sel_res['tvotes'];
        $total_votes = $prev_votes + 1;
        echo $total_votes;

        // Update the database with the new vote count
        $can_up_query = "UPDATE candidate SET tvotes='$total_votes' WHERE id='$id'";
        $can_up_data = mysqli_query($con, $can_up_query);

        // Increment the counter for the next position
        $i++;
    }

    // Update the voter's status to indicate they have voted
    $voter_up_query = "UPDATE register SET status='voted' where phone='$_SESSION[phone]'";
    $voter_up_data = mysqli_query($con, $voter_up_query);

    // If the update is successful, update the session and redirect to the 'voted' page
    if($voter_up_data) {
        $_SESSION['status'] = "voted";

        echo "<script>
                location.href='voted.php'
            </script>";
    }

?>
