<?php
    // Start a session for maintaining user state and configurations
    session_start();

    // Suppress PHP errors from being displayed (not recommended for production)
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page metadata and styles -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Online Voting System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Inline styling for alert messages */
        .msg {
            text-align: center;
            color: red;
            margin: 1rem;
        }
    </style>
</head>
<body>
   <div class="container">
        <!-- Page heading -->
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Informational message about the purpose of the form -->
        <div class="msg"><b>Note:</b> Fill this form to request a phone number change. An SMS will be sent to your new phone number after verification.</div>

        <!-- Form for submitting a phone number change request -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form">
                <h4>Mobile Number Change Request</h4>

                <!-- Input field for name -->
                <label class="label"><sup class="req_symbol">*</sup>Name:</label>
                <input type="text" name="name" class="input" placeholder="Enter Your Name" required>

                <!-- Dropdown for selecting ID proof -->
                <label class="label"><sup class="req_symbol">*</sup>Choose ID Proof:</label>
                <select name="idname" id="myselect" class="input" onchange="idproof()">
                    <option value="Aadhar">Aadhar</option>
                    <option value="Pan Card">Pan Card</option>
                    <option value="Voter Card">Voter Card</option>
                    <option value="Passport">Passport</option>
                    <option value="other Id Proof">Other Id Proof</option>
                </select>

                <!-- File upload field for ID proof -->
                <label class="label" id="myid"><sup class="req_symbol">*</sup>Aadhar:</label>
                <input type="file" accept="image/*" name="idphoto" id="myfile" class="input" required>

                <!-- Input fields for other details like DOB, old and new phone numbers -->
                <label class="label"><sup class="req_symbol">*</sup>Date of Birth:</label>
                <input type="date" name="dob" class="input" required>

                <label class="label"><sup class="req_symbol">*</sup>Old Phone Number:</label>
                <input type="text" name="oldphno" class="input" placeholder="Enter Old/Lost Phone Number" required>

                <label class="label"><sup class="req_symbol">*</sup>New Phone Number:</label>
                <input type="text" name="newphno" class="input" placeholder="Enter New Phone Number" required>

                <!-- Submit button for sending the request -->
                <button class="button" name="submit">Send Request</button>    
            </div>
        </form>
   </div>

   <!-- Script to dynamically update label text based on selected ID proof -->
   <script>
       function idproof() {
            var x = document.getElementById("myselect").value;
            document.getElementById("myid").innerHTML = x + ":";
       }
   </script>
</body>
</html>

<?php
    // Check if the form is submitted
    if(isset($_POST['submit'])) {
        // Establish connection to the database
        $con = mysqli_connect("localhost", "root", "", "voting");

        // Retrieve form inputs
        $name = $_POST['name'];
        $idname = $_POST['idname'];
        $dob = $_POST['dob'];
        $oldphno = $_POST['oldphno'];
        $newphno = $_POST['newphno']; 

        // Handle file upload
        $filename = $_FILES["idphoto"]["name"];
        $tempname = $_FILES["idphoto"]["tmp_name"];
        $folder = "phnochange/" . $filename;
        move_uploaded_file($tempname, $folder);

        // Debugging purpose: Print the uploaded file path
        echo $folder;

        // Insert data into the database
        $query = "INSERT INTO phno_change(vname, idname, idcard, dob, old_phno, new_phno) 
                  VALUES('$name','$idname','$folder','$dob','$oldphno','$newphno')";
        $data = mysqli_query($con, $query);

        // Check if the database insertion was successful
        if($data) {
           echo 
           "
                <script>
                    alert('Request sent successfully');
                </script>
           ";
        }
    }
?>
