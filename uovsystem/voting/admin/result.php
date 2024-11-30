<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags to define the character set, compatibility, and responsive design for mobile devices -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title of the webpage that appears in the browser tab -->
    <title>Document</title>
</head>
<body>

    <!-- Canvas element where the chart will be rendered -->
    <canvas id="myChart"></canvas>

    <!-- Script to load the Chart.js library, which is used for creating charts -->
    <script src="../js/chart.js"></script>

    <script>
        // Get the context of the canvas where the chart will be drawn
        const ctx = document.getElementById('myChart').getContext('2d');

        // Create a new Chart using the context, defining its type and data
        const myChart = new Chart(ctx, {
            type: 'bar',  // Set chart type to 'bar' (bar chart)
            
            // Data object containing labels and dataset for the chart
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],  // Labels for the x-axis
                datasets: [{
                    label: '# of Votes',  // Label for the dataset
                    data: [12, 19, 3, 5, 2, 3],  // Data points for each label
                    backgroundColor: [  // Array of colors for the bars' background
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [  // Array of colors for the border of the bars
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1  // Set the width of the border around each bar
                }]
            },
        });
    </script>

</body>
</html>
