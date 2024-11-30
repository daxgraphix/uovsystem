<?php
    // Initialize a variable to track the index of each chart
    $i = 0;

    // Loop through each position in the pos_data array
    while($pos_row = mysqli_fetch_assoc($pos_data))
    {
        // Get the position name from the current row
        $pos = $pos_row['position_name'];

        // Query the database to get all candidates for the current position
        $can_query1 = "SELECT * FROM candidate WHERE position='$pos'";
        $can_data1 = mysqli_query($con, $can_query1);

        // Generate the JavaScript code for creating the chart
        // Get the context of the canvas for the chart
        echo "ctx[$i] = document.getElementsByClassName('myChart')[$i].getContext('2d');
              myChart[$i] = new Chart(ctx[$i], {
                  type: 'bar',
                  data: {
                      labels: ["; 

        // Loop through each candidate for the current position and generate the chart labels
        while($can_row = mysqli_fetch_assoc($can_data1))
        {
            echo "'$can_row[cname]',";  // Candidate names as chart labels
        }

        // Continue the chart setup with dataset for votes
        echo "],
        datasets: [{
            label: '$pos',  // Position name as the label
            data: [";

        // Query the database again to get the votes for each candidate in this position
        $can_query2 = "SELECT * FROM candidate WHERE position='$pos'";
        $can_data2 = mysqli_query($con, $can_query2);

        // Loop through the second query result to get the vote counts for each candidate
        while($can_row1 = mysqli_fetch_assoc($can_data2))
        {
            echo "$can_row1[tvotes],";  // Candidate votes as chart data
        }

        // Close the dataset definition
        echo" ],
        backgroundColor: [
            'rgba(54, 162, 235, 0.2)'  // Chart color for the bars
        ],
        borderColor: [
            'rgba(54, 162, 235, 1)'  // Border color for the bars
        ],
        borderWidth: 1  // Border width for the bars
    }]
},
});";

        // Increment the index to generate the next chart
        $i++;
    }
?>
