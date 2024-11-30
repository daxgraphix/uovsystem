<?php
// Retrieve the 'psnm' and 'id' values from the URL parameters using the GET method.
$psnm = $_GET['psnm'];  // Candidate position name
$id = $_GET['id'];      // Candidate position ID
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags to set the character encoding, compatibility, and viewport settings for responsive design -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the web page -->
    <title>University Online Voting System</title>
    <!-- Linking to an external CSS file for styling -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <div class="container">
        <!-- Heading of the page -->
        <div class="heading"><h1>University Online Voting System</h1></div>

        <!-- Form to update the candidate position -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h4>Candidate Position Update</h4>

                <!-- Label and input field for entering the updated candidate position -->
                <label class="label">Candidate Position:</label>
                <!-- Pre-fill the input field with the current candidate position (using the $psnm variable) -->
                <input type="text" name="position" id="" class="input" value="<?php echo $psnm; ?>">

                <!-- Submit button to trigger the update action -->
                <button class="button" name="update">Update</button>
            </div>
        </form>
   </div> 

   <?php
    // Check if the 'update' button was clicked
    if (isset($_POST['update'])) {
        // Get the updated position value from the form
        $position = $_POST['position'];

        // Establish a connection to the MySQL database
        $con = mysqli_connect("localhost", "root", "", "voting");

        // SQL query to update the candidate's position in the database using the 'id' parameter
        $query = "UPDATE can_position SET position_name='$position' WHERE id='$id'";

        // Execute the SQL query
        $data = mysqli_query($con, $query);

        // If the query executes successfully, display an alert and redirect to the 'position.php' page
        if ($data) {
            echo "
                <script>
                    alert('Position updated successfully!');
                    location.href='position.php';  // Redirect to the position page after success
                </script>
            ";
        }
    }
   ?>
</body>
</html>
