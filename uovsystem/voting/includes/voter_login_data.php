<?php
        // Query the database to retrieve the user's registration details using the provided phone number
        $reg_query="SELECT * FROM register WHERE phone='$phone'";
        $reg_data=mysqli_query($con,$reg_query);
        $result=mysqli_fetch_assoc($reg_data);

        // Store the user's details in session variables for later use
        $_SESSION['fname']=$result['fname']; // First name
        $_SESSION['lname']=$result['lname']; // Last name
        $_SESSION['idnum']=$result['lname']; // ID number (possibly a typo: should be 'idnum')
        $_SESSION['phone']=$result['phone']; // Phone number
        $_SESSION['idcard']=$result['idcard']; // ID card number
        $_SESSION['verify']=$result['verify']; // Verification status (yes or no)
        $_SESSION['password']=$result['password']; // User's password
        $_SESSION['status']=$result['status']; // User's account status
        $_SESSION['otp']=null; // OTP initialization

        // Check if the phone number exists in session or the resend flag is set
        if($_SESSION['phone']!=null or $resend==1)
        {
            // Verify if the phone number in session matches the provided phone
            if($phone==$_SESSION['phone'])
            {
                
                // Check if the user's phone is verified by the admin
                if($_SESSION['verify']=="yes")
                {
                    // Set user login status to true and clear any previous error
                    $_SESSION['userLogin']=1;
                    $_SESSION['error']="";

                    $err = ""; // Initialize error variable
                    $ses = ""; // Initialize session variable (not used)
                    $otp = rand(1111,9999); // Generate a random OTP

                    // Save the generated OTP in the session
                    $_SESSION['otp']=$otp;

                    // Validate phone number format: numeric and exactly 10 digits
                    if(preg_match("/^\d+\.?\d*$/",$phone) && strlen($phone)==10)
                    {

                        // Prepare data for the OTP SMS API request
                        $fields = array(
                            "variables_values" => "$otp",
                            "route" => "otp",
                            "numbers" => "$phone",
                        );

                        // Initialize cURL session to send the SMS request
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 60,
                            CURLOPT_SSL_VERIFYHOST => 0,
                            CURLOPT_SSL_VERIFYPEER => 0,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "POST",
                            CURLOPT_POSTFIELDS => json_encode($fields),
                            CURLOPT_HTTPHEADER => array(
                                "authorization: xbKfLvBOTiW67p3AkXgDZqMo8my9aCRPNGnuVscl02JwzhY41E4KXQ3gnFdRwHmbfDSZuahjIiP8OsAr", // API key
                                "accept: */*",
                                "cache-control: no-cache",
                                "content-type: application/json"
                            ),
                        ));

                        // Execute the cURL request and handle the response
                        $response = curl_exec($curl);
                        $err = curl_error($curl); // Capture any errors during the request

                        curl_close($curl); // Close the cURL session

                        // If there's an error in sending the SMS
                        if ($err) 
                        {
                            echo "
                                <script>
                                alert('sms not send! please check connection')
                                </script>
                            ";
                        }
                        else
                        {
                            // Parse the response to check if the OTP was successfully sent
                            $data = json_decode($response);
                            $sts = $data->return;
                            if ($sts == false)
                            {
                                $err = "Otp Not Send";
                            }
                            else
                            {
                                // Show success message if OTP was sent successfully
                                echo "
                                <script>
                                alert('OTP send on your phone')
                                </script>
                            ";
                            }
                        }
                    }
                    else
                    {
                        // Show error if the phone number format is invalid
                        $err = "Invalid Mobile Number";
                    }
                }
            
                else
                {
                    // Show alert if the user's phone is not verified by the admin
                    echo "
                    <script>
                    alert('you are not verified by Admin')
                    location.href='index.php'
                    </script>
                    ";
                }
            }
        }
        else if($_SESSION['phone']==null)
        {
            // Show alert if the phone number is not registered in the system
            echo "
                    <script>
                    alert('phone number not registered')
                    history.back()
                    </script>
                    ";
        }
?>
