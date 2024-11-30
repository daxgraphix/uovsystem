<?php
// Start the session to track the user
session_start();

// Check if the user is logged in as admin, if not redirect to the login page
if($_SESSION['adminLogin']!=1)
{
    header("location:index.php"); // Redirect to the login page if the admin is not logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set the character encoding and viewport for responsive design -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <div class="container">
        <!-- Form for candidate registration -->
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Main heading of the page -->
            <div class="heading"><h1>University Online Voting System</h1></div>
            <div class="form">
                <!-- Form title for candidate registration -->
                <h4>Candidate Registration</h4>

                <!-- Input field for candidate name -->
                <label class="label">Candidate Name:</label>
                <input type="text" name="cname" class="input" placeholder=" Enter Candidate Name" required>

                <!-- Input field for candidate symbol name -->
                <label class="label">Symbol Name:</label>
                <input type="text" name="csymbol" class="input" placeholder="Enter Candidate Symbol Name" required>

                <!-- Input for candidate symbol image -->
                <label class="label">Choose symbol Image:</label>
                <input type="file" accept="image/*" name="cphoto" class="input" required>

                <!-- Dropdown for selecting the position -->
                <label class="label">Select Position:</label>
                <select name="position" class="input">
                    <?php
                        // Include the file that fetches position data from the database
                        include "../includes/all-select-data.php";

                        // Loop through the data and display position options
                        while($result=mysqli_fetch_assoc($pos_data))
                        {
                            echo "<option value='$result[position_name]'>$result[position_name]</option>";
                        }
                    ?>
                </select>

                <!-- Submit button for registration -->
                <button class="button" name="register">Register</button>
            </div>
        </form>
   </div>
</body>
</html>

<?php
    // Check if the form has been submitted
    if(isset($_POST['register']))
    {
        // Establish a connection to the database
        $con=mysqli_connect("localhost","root","","voting");

        // Get the form data submitted by the user
        $cname=$_POST['cname'];
        $csymbol=$_POST['csymbol'];
        $position=$_POST['position'];

        // Handle the uploaded image
        $filename=$_FILES["cphoto"]["name"];
        $tempname=$_FILES["cphoto"]["tmp_name"];
        $folder="symbol/".$filename;

        // Move the uploaded file to the specified folder
        move_uploaded_file($tempname,$folder);

        // Insert the candidate data into the database
        $query="INSERT INTO candidate(cname,symbol,symphoto,position) VALUES('$cname','$csymbol','$folder','$position')";
        $data=mysqli_query($con,$query);

        // Check if the insertion was successful
        if($data)
        {
            // Display success message and redirect to the candidates page
            echo "<script>
                    alert('Candidate Registered successfully')
                    location.href='candidates.php'
                </script>";
        }
        else
        {
            // Display error message if the symbol name already exists
            echo "<script> alert('Candidate Symbol Name already exists!') </script>";
        }
    }
?>
