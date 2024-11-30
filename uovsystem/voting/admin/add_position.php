<?php
// Start a new session or resume the existing one
session_start();

// Check if the admin is logged in; if not, redirect to the login page
if($_SESSION['adminLogin'] != 1) {
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding, compatibility, and responsiveness -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Linking external stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <!-- Page header -->
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Form for adding positions -->
        <div class="form">
            <h4>Add Positions</h4>
            <form action="" method="POST">
                <!-- Input for position name -->
                <label class="label">Position Name:</label>
                <input type="text" name="position" class="input" placeholder="Enter position" required>
                <!-- Submit button -->
                <button class="button" name="add">Add</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Establish a connection to the MySQL database
$con = mysqli_connect("localhost", "root", "", "voting");

// Check if the "Add" button is clicked
if(isset($_POST['add'])) {
    // Retrieve the position name from the form
    $pos_name = $_POST['position'];
    echo $pos_name;

    // Insert the position name into the 'can_position' table
    $query = "INSERT INTO can_position (position_name) VALUES ('$pos_name')";
    $data = mysqli_query($con, $query);

    // Check if the insertion was successful
    if($data) {
        // Display success alert and redirect to 'position.php'
        echo "
        <script>
            alert('Position added successfully');
            location.href = 'position.php';
        </script>";
    } else {
        // Display error alert and redirect back to the previous page
        echo "
        <script>
            alert('Position already added!');
            history.back();
        </script>";
    }
}
?>
