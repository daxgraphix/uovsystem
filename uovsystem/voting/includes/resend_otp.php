<?php 

// Start the session to access session variables
session_start();

// Destroy all session data, effectively logging the user out
session_destroy();

// Use JavaScript to go back to the previous page in the browser's history
echo "
<script>
    history.back()
</script>
";

?>
