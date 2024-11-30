<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character set, browser compatibility, and responsiveness -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title of the web page -->
    <title>University Online Voting System</title>
    <!-- Link to external CSS file for styling -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <!-- Main container for the content of the page -->
   <div class="container">
        <!-- Header with the main title of the system -->
        <div class="heading"><h1>University Online Voting System</h1></div>
        
        <!-- Registration form for voter -->
        <form action="register_data.php" method="POST" enctype="multipart/form-data">
            <div class="form">
                <!-- Section heading for voter registration -->
                <h4>Voter Registration</h4>
                
                <!-- First Name field -->
                <label class="label"><sup class="req_symbol">*</sup>Firstname:</label>
                <input type="text" name="fname" id="firstname" class="input" placeholder=" Enter First Name" required>

                <!-- Last Name field -->
                <label class="label"><sup class="req_symbol">*</sup>Lastname:</label>
                <input type="text" name="lname" class="input" placeholder="Enter Last Name" required>

                <!-- Dropdown menu for selecting ID proof -->
                <label class="label"><sup class="req_symbol">*</sup>Choose ID Proof:</label>
                <select name="idname" id="myselect" class="input" onchange="idproof()">
                    <option value="Aadhar">Aadhar</option>
                    <option value="Pan Card">Pan Card</option>
                    <option value="Voter Card">Voter Card</option>
                    <option value="Passport">Passport</option>
                    <option value="Other ID Card">Other ID Card</option>
                </select>
                
                <!-- Dynamic labels and fields based on ID proof selection -->
                <label class="label" id="myid1"><sup class="req_symbol">*</sup>Adhar No:</label>
                <input type="text" name="idnum" placeholder="Enter id Number" class="input" required>

                <!-- File input for uploading ID card image -->
                <label class="label" id="myid"><sup class="req_symbol">*</sup>Aadhar:</label>
                <input type="file" accept="image/*" name="idcard" id="myfile" class="input" required>

                <!-- Institute ID field -->
                <label class="label" id="myid1"><sup class="req_symbol">*</sup>Institute Id No:</label>
                <input type="text" name="instidnum" placeholder="Enter Institute id Number" class="input" required>

                <!-- Date of birth field -->
                <label class="label"><sup class="req_symbol">*</sup>Date of Birth:</label>
                <input type="date" name="dob" class="input" required>

                <!-- Gender selection options -->
                <label class="label"><sup class="req_symbol">*</sup>Gender:</label>
                <input type="radio" value="male" name="gender" class="radio" required>Male
                <input type="radio" value="female" name="gender" class="radio">Female
                <input type="radio" value="other" name="gender" class="radio">Other

                <!-- Phone Number field -->
                <label class="label"><sup class="req_symbol">*</sup>Phone Number:</label>
                <input type="text" name="phone" class="input" placeholder="Enter Phone Number" required>

                <!-- Address field -->
                <label class="label"><sup class="req_symbol">*</sup>Address:</label>
                <input type="text" name="address" class="input" placeholder="Enter Address" required>

                <!-- Register button -->
                <button class="button" name="register">Register</button>

                <!-- Link to login page if the user already has an account -->
                <div class="link1">Already have an account? <a href="index.php">Login here</a></div>
            </div>
        </form>
   </div> 

   <!-- Message display section -->
   <p class="msg"></p>

   <!-- JavaScript to dynamically change ID proof-related fields based on selection -->
   <script>
       function idproof()
       {
            // Get the selected ID type and update the labels accordingly
            var x = document.getElementById("myselect").value;
            document.getElementById("myid").innerHTML = x + ":";
            document.getElementById("myid1").innerHTML = x + " No:";
       }
   </script>
</body>
</html>
