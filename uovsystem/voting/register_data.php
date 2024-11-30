<?php

    // Disable error reporting for this script
    error_reporting(0);

    // Include a file that likely fetches necessary data for voter registration
    include "includes/all-select-data.php";

    // Get the number of records from the voter data query result
    $count = mysqli_num_rows($voter_data);

    // Retrieve the values submitted via the POST request for form fields
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $idname = $_POST['idname'];
    $idnum = $_POST['idnum'];
    $instidnum = $_POST['instidnum'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Check if the form was submitted
    if (isset($_POST['register'])) {
        // Establish a connection to the MySQL database
        $con = mysqli_connect("localhost", "root", "", "voting");

        // Create DateTime objects for the birthdate and the current date
        $date1 = new DateTime("$dob");
        $date2 = new DateTime("now");

        // Calculate the difference in days between the birthdate and current date
        $dateDiff = $date1->diff($date2);

        // Validation checks for input data
        if (strlen($phone) != 10) {
            // Alert if the phone number length is not 10 digits
            echo "<script> 
                    alert('Phone Number must 10 digit')
                    history.back()
                </script>";
        }
        else if (!is_numeric($phone)) {
            // Alert if the phone number contains non-numeric characters
            echo "<script> 
                    alert('Phone Number must numeric')
                    history.back()
                </script>";
        }
        else if (strlen($idnum) > 13) {
            // Alert if the ID number is too long
            echo "<script> 
                    alert('Enter valid Id number')
                    history.back()
                </script>";
        }
        else if ($dateDiff->days < 6570) { // 18 years in days
            // Alert if the user is younger than 18 years old
            echo "<script>
                    alert('Your age must above 18 years')
                    history.back()
                </script>";
        }
        else {
            // Handle file upload for the ID card image
            $filename = $_FILES["idcard"]["name"];
            $tempname = $_FILES["idcard"]["tmp_name"];
            $folder = "img/" . $count . $filename;

            // Move the uploaded file to the designated folder
            move_uploaded_file($tempname, $folder);

            // Insert the registration data into the database
            $query = "INSERT INTO register(fname, lname, idname, idnum, idcard, inst_id, dob, gender, phone, address, status) 
                      VALUES('$fname', '$lname', '$idname', '$idnum', '$folder', '$instidnum', '$dob', '$gender', '$phone', '$address', 'not voted')";
            $data = mysqli_query($con, $query);

            // Check if the insertion was successful and notify the user
            if ($data) {
                echo "<script>
                        alert('Registration Successfully!')
                        location.href='index.php'
                    </script>";
            } else {
                // Alert if there's a conflict with the mobile number or ID number (already exists)
                echo "<script>
                        alert('mobile number or ID Number already exist!')
                        history.back()
                     </script>";
            }
        }
    }

?>
