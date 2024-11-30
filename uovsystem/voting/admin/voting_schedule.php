<html lang="en">
<head>
    <!-- Meta tags to ensure proper character encoding, compatibility, and responsive design -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the page displayed in the browser tab -->
    <title>University Online Voting System</title>

    <!-- Link to external CSS file for styling the page -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <!-- Main container for the content of the page -->
   <div class="container">
        <!-- Heading section displaying the title of the system -->
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Form section for setting the voting schedule -->
        <div class="form">
            <!-- Subheading for the voting schedule form -->
            <h4>Voting Schedule</h4>
            
            <!-- Form to input the start and end date for the voting period -->
            <form action="" method="POST">
                <!-- Label and input for the start date and time of voting -->
                <label class="label">Valid From:</label>
                <input type="datetime-local" name="start" class="input" required>

                <!-- Label and input for the end date and time of voting -->
                <label class="label">Valid To:</label>
                <input type="datetime-local" name="end" class="input" required>
                
                <!-- Submit button to set the voting schedule -->
                <button class="button" name="set">Set</button>
            </form>
        </div>
   </div>
</body>
</html>

<?php
    // Establishing a connection to the MySQL database
    $con=mysqli_connect("localhost","root","","voting");

    // Check if the form has been submitted
    if(isset($_POST['set']))
    {
        // Retrieve the start and end dates from the form
        $starting = $_POST['start'];
        $ending = $_POST['end'];

        // SQL query to update the voting start and end dates in the database
        $query="UPDATE voting SET vot_start_date='$starting', vot_end_date='$ending'";

        // Execute the query and store the result
        $data=mysqli_query($con,$query);

        // Check if the query was successful
        if(!$data)
        {
            // Display an alert if there was an error in updating the data
            echo "<script> alert('something went wrong!') </script>";
        }
        else
        {
            // Display a success message if the update was successful
            echo "<script> alert('Successfully update') </script>";
        }
    }
?>
