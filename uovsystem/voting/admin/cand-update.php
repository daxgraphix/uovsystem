<?php
// Retrieve values from the GET request for candidate details (name, symbol, position)
$cn=$_GET['cn'];
$sy=$_GET['sy'];
$ps=$_GET['ps'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <div class="container">
        <div class="heading"><h1>University Online Voting System</h1></div>
        <!-- Form for updating candidate information -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h4>Candidate Information Update</h4>
                <!-- Candidate Name input field -->
                <label class="label">Candidate Name:</label>
                <input type="text" name="cname" id="" class="input" value="<?php echo $cn; ?>">

                <!-- Candidate Symbol Name input field -->
                <label class="label">Candidate Symbol Name:</label>
                <input type="text" name="symbol" id="" class="input" value="<?php echo $sy; ?>">
                
                <!-- Dropdown for selecting candidate position -->
                <label class="label">Candidate Position:</label>
                <select name="position" class="input">
                    <?php
                    // Include external file for position data
                    include "../includes/all-select-data.php";

                    // Pre-select the current position of the candidate
                    echo "<option value='$ps'>$ps (already selected)</option>";
                    
                    // Loop through available positions and display them in the dropdown
                    while($result=mysqli_fetch_assoc($pos_data))
                    {
                        echo "<option value='$result[position_name]'>$result[position_name]</option>";
                    }
                    
                    ?>
                </select>

                <!-- Submit button to update the candidate information -->
                <button class="button" name="update">Update</button>
            </div>
        </form>
   </div> 

   <?php
    // Check if the form has been submitted for updating candidate information
    if(isset($_POST['update']))
    {
        // Retrieve data from the form input fields
        $cname=$_POST['cname'];
        $symbol=$_POST['symbol'];
        $position=$_POST['position'];

        // Output candidate name for debugging
        echo $cname;

        // SQL query to update candidate information in the database
        $query="UPDATE candidate SET cname='$cname',symbol='$symbol',position='$position' where symbol='$sy'";

        // Execute the query and store the result
        $data=mysqli_query($con,$query);

        // Check if the update was successful
        if($data)
        {
            // Display success message and redirect to candidates page
            echo "<script>
                    alert('Candidate updated successfully')
                    location.href='candidates.php'
                </script>";
        }
    }
   ?>
