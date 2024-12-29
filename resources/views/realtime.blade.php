<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Data</title>
   
    
</head>
<body>
    <h1>Real-Time Data from Dhan API</h1>
    <div id="data-container">Waiting for data...</div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.Echo.channel('dhandata')
                .listen('DataReceived', (event) => {
                    const dataContainer = document.getElementById('data-container');
                dataContainer.innerHTML = JSON.stringify(event.data, null, 2);
            });
        });
    </script>
</body>
</html>
