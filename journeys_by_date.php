<?php include ('fleet_management_header.php') ?>
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
</head>
<section class="forms">
<body>
    <form method="POST" action="">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit" >View</button>
    </form>
</section>
</body>

</html>

<?php
// Include the database connection file
require_once 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the start and end dates from the form
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    // Prepare the SQL query with the date range
    $sql = "SELECT * FROM journeys WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date DESC";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Display the records on a web form
    if (mysqli_num_rows($result) > 0) {
        echo "<style>
                table {
                    border-collapse: collapse;
                    margin: 2.5rem 7rem;
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
                }
                th.title {
                    text-align: center;
                    background-color: white;
                    width: auto;
					padding-top:2rem;
                }
                .census-dates {
                    text-align: left;
                    padding-top:1.5rem;
                }
                .date-column {
                    width: 200px; /* Adjust the width as needed */
                    text-align: left;
                    pading:5px;
                }
				.data-column {
                    width: 200px; /* Adjust the width as needed */
                    text-align: left;
                    pading:5px;
                }
             </style>";

        echo "<table>";
        echo "<tr>
                <th colspan='37' class='title'>JOURNEY REPORT </th>
              </tr>";


        // Column headers
        echo "<tr>
                <th>ID</th>
                <th>Date</th>
                <th>VehicleID</th>
                <th>DriverID</th>
                <th>Purpose of Journey</th>
                
              </tr>";

        $currentMonth = '';
        $row_count = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $date = date('F Y', strtotime($row['Date'])); // Get the month and year from the date

            // Display month header if it has changed
            if ($currentMonth !== $date) {
                $currentMonth = $date;
                echo "<tr>
                        <td colspan='37' class='census-dates'><strong>$currentMonth</strong></td>
                      </tr>";
            }

            // Display record
            echo "<tr>
                    
                    <td>" . $row['ID'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['VehicleID'] . "</td>
                    <td>" . $row['DriverID'] . "</td>
                    <td>" . $row['Purpose of Journey'] . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>


