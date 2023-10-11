<?php 
    session_start ();
    if(!isset($_SESSION["login"]))
    
        header("location:login.php"); 
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Pie Charts</title>
    <style>
        /* Style to display the container as flex and align items horizontally */
        #charts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; 
        }

        .chart-container {
            margin-bottom: 20px; 
            width: 400px; 
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="charts-container"></div>

    <script>
        // Fetch data from PHP using AJAX
        fetch('dashboard.php')
        .then(response => response.json())
        .then(data => {
            // Create a pie chart for each title
            data.forEach((item, index) => {
                const { title, yes_percentage, no_percentage, other_percentage } = item;

                // Create a chart container div
                const chartContainer = document.createElement('div');
                chartContainer.classList.add('chart-container');

                // Create a heading for the title
                const heading = document.createElement('h2');
                heading.textContent = title;
                chartContainer.appendChild(heading);

                const ctx = document.createElement('canvas');
                ctx.width = 400;
                ctx.height = 400;

                chartContainer.appendChild(ctx);

                // Append the chart container to the main charts-container div
                document.getElementById('charts-container').appendChild(chartContainer);

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Yes', 'No', 'Other'],
                        datasets: [{
                            data: [yes_percentage, no_percentage, other_percentage],
                            backgroundColor: ['rgb(186, 203, 72)', 'orange', 'skyblue']
                        }]
                    },
                    options: {
                        responsive: false,
                    }
                });

                // Add a line break after every third chart
                if ((index + 1) % 3 === 0) {
                    document.getElementById('charts-container').appendChild(document.createElement('br'));
                }
            });
        })
        .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
