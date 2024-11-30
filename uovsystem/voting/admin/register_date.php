<html lang="en">
<head>
    <!-- Meta tags for character encoding, browser compatibility, and responsiveness -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the webpage displayed in the browser tab -->
    <title>University Online Voting System</title>
    <!-- Linking external stylesheet for styling the page -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <!-- Main container to hold the entire content of the page -->
   <div class="container">
        <!-- Heading section displaying the title of the page -->
        <div class="heading"><h1>Online Voting System</h1></div>
        
        <!-- Form section for setting registration validity for voting -->
        <div class="form">
            <h4>Registration Validity for Voting</h4>
            <!-- Form that captures the start and end date-time for the registration period -->
            <form action="" method="POST">
                <!-- Label and input field for selecting the start date-time for registration -->
                <label class="label">Valid From:</label>
                <input type="datetime-local" name="start" class="input" required>

                <!-- Label and input field for selecting the end date-time for registration -->
                <label class="label">Valid To:</label>
                <input type="datetime-local" name="end" class="input" required>
                
                <!-- Submit button to submit the form -->
                <button class="button" name="set">Set</button>
            </form>
        </div>
   </div>
</body>
</html>

<?php
    // Connecting to the MySQL database to manage voting data
    $con=mysqli_connect("localhost","root","","voting");
    
    // Checking if the form is submitted
    if(isset($_POST['set']))
    {
        // Retrieving the start and end date-time values from the form
        $starting = $_POST['start'];
        $ending = $_POST['end'];
        
        // SQL query to update the registration start and end dates in the database
        $query="UPDATE voting SET reg_start_date='$starting', reg_end_date='$ending'";
        
        // Executing the query and checking if it was successful
        $data=mysqli_query($con,$query);

        // Displaying an alert message based on the result of the query execution
        if(!$data)
        {
            echo "<script> alert('something went wrong!') </script>";
        }
        else
        {
            echo "<script> alert('Successfully updated') </script>";
        }
    }
?>
