
<!DOCTYPE html>
<html>

<head>
    <title>Display Records</title>
    <style>
        form {
            text-align: center;
			padding:0.4rem;
            font-size: 2rem;
            display: flex; 
            flex-direction:row;
            align-items: center;
			justify-content:center;
			gap: 1rem;
			margin:0.5rem;
        }

        form button {
            font-size: 1.2rem;
            height: 2rem;
            width: 5rem;
            padding: 0.3rem;
            box-sizing: border-box;
			margin:1.5rem;
        }
        form select {
            font-size: 1.2rem;
            height: 2rem;
            width: 11rem;
            padding: 0.3rem;
            box-sizing: border-box;
            text-align: center;
			margin:0.5rem;
        }

        .forms {
            margin-top: 5rem;
            color: maroon;
            background-color: skyblue;
            text-align: center;
        }
    </style>
	<script>
        // Function to load the fleet management header
        function loadHeader() {
            fetch('fleet_management_header.php')
                .then(response => response.text())
                .then(data => {
                    // Insert the header content into the header element
                    document.getElementById('header').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading header:', error);
                });
        }

        // Call the loadHeader function when the page finishes loading
        window.addEventListener('DOMContentLoaded', loadHeader);
    </script>
</head>

<body>
  <section id="header"></section>
    <section class="forms">
        <form method="POST" action="">
            <label>Vehicle Report </label>
            <select id="VehicleID" name="VehicleID">
                <?php
                // Include the database connection file
                require_once 'db_connection.php';

                // Retrieve all VehicleIDs from the table
                $sql = "SELECT DISTINCT VehicleID FROM journeys ORDER BY VehicleID ASC";
                $result = mysqli_query($connection, $sql);

                // Display the VehicleIDs in the dropdown list
                while ($row = mysqli_fetch_assoc($result)) {
                    $VehicleID = $row['VehicleID'];
                    echo "<option value='$VehicleID'>$VehicleID</option>";
                }
                ?>
            </select>

            <button type="submit">View</button>
        </form>
    </section>
</body>

</html>

<?php
// Include the database connection file
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the driver from the form
    $VehicleID = $_POST['VehicleID'];

    // Prepare the SQL query with the VehicleID
    $sql = "SELECT Date, DriverID, VehicleID, `Purpose of Journey` FROM journeys WHERE VehicleID = '$VehicleID' ORDER BY Date ASC";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Display the records on a web form
    if (mysqli_num_rows($result) > 0) {
        echo "<style>
                table {
                    border-collapse: collapse;
                    margin: 2.5rem 9rem;
                }
                th {
                    border: 1px solid black;
                    padding: 5px;
                    width: auto;
                    text-align: center;
                    background-color: skyblue;
                }
                td {
                    border: 1px solid black;
                    padding: 5px;
                    width: auto;
                    text-align: left;
                }
                th.title {
                    text-align: center;
                    background-color: white;
                    width: auto;
					padding-top:2rem;
                }
             </style>";

        echo "<table>";
        echo "<tr>
                <th>Date</th>
                <th>DriverID</th>
                <th>VehicleID</th>
                <th>Purpose of Journey</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['DriverID'] . "</td>
                    <td>" . $row['VehicleID'] . "</td>
                    <td>" . $row['Purpose of Journey'] . "</td>
                  </tr>";
        }

        echo "</table>";
    } 
	else {
        echo "No records found.";
    }
}
?>
