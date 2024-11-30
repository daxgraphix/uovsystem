<?php
// Start the session to access session variables
session_start();

// Check if the admin is logged in (adminLogin session variable should be 1)
// If not logged in, redirect to the login page (index.php)
if($_SESSION['adminLogin'] != 1) {
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
    <!-- Link to the external stylesheet for page styling -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <div class="container">
        <!-- Form to set the title for voting -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="heading">
                <h1>University Online Voting System</h1>
            </div>
            <div class="form">
                <h4>Title for Voting</h4>
                <label class="label">Title:</label>
                <!-- Input field for the admin to enter the voting title -->
                <input type="text" name="title" class="input" placeholder="Enter voting title" required>
                <!-- Submit button to set the title -->
                <button class="button" name="set">Set</button>
            </div>
        </form>
   </div>
</body>
</html>

<?php
// Check if the form was submitted (if 'set' button is clicked)
if(isset($_POST['set'])) {
    // Connect to the MySQL database (localhost, username 'root', password '', database 'voting')
    $con = mysqli_connect("localhost", "root", "", "voting");

    // Get the entered voting title from the form
    $title = $_POST['title'];

    // Query to update the voting title in the database
    $query = "UPDATE voting SET voting_title='$title'";

    // Execute the query
    $data = mysqli_query($con, $query);

    // If the query is successful, show a success message
    if($data) {
        echo "<script> alert('Title set Successfully!') </script>";
    } else {
        // If the query fails (e.g., duplicate entry), show an error message
        echo "<script> alert('Candidate Symbol Name already exist!') </script>";
    }
}
?>
