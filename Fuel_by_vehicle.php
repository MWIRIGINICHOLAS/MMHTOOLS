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

<body>
    <section class="forms">
        <form method="POST" action="">
		    <label for="VehicleID" >Vehicle:</label>
            <select id="VehicleID" name="VehicleID">
                <?php
                // Include the database connection file
                require_once 'db_connection.php';

                // Retrieve all VehicleIDs from the table
                $sql = "SELECT DISTINCT VehicleID FROM fuel ORDER BY VehicleID ASC";
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
    $sql = "SELECT Date, VehicleID, Cost, Source FROM fuel WHERE VehicleID = '$VehicleID' ORDER BY Date DESC";

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
                th.month {
                    background-color: lightgray;
                    text-align: center;
                }
            </style>";

        echo "<table>";
        echo "<tr>
                <th>Date</th>
                <th>VehicleID</th>
                <th>Cost</th>
                <th>Source</th>
              </tr>";

        $currentMonth = '';
        $totalCost = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $date = strtotime($row['Date']);
            $monthYear = date('F Y', $date);

            if ($currentMonth !== $monthYear) {
                if ($currentMonth !== '') {
                    echo "<tr>
                            <td class='title' colspan='2'>Total</td>
                            <td class='title' style='color: red; font-weight: bold;'>" . number_format($totalCost, 2) . "</td>
                            <td class='title'></td>
                          </tr>";
                }

                echo "<tr>
                        <th class='title' colspan='4'>$monthYear</th>
                      </tr>";

                echo "<tr>
                        <th class='month'>Date</th>
                        <th class='month'>VehicleID</th>
                        <th class='month'>Cost</th>
                        <th class='month'>Source</th>
                      </tr>";
                $currentMonth = $monthYear;
                $totalCost = 0;
            }

            $cost = str_replace(',', '', $row['Cost']); // Remove commas from the cost
            echo "<tr>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['VehicleID'] . "</td>
                    <td>" . $cost . "</td>
                    <td>" . $row['Source'] . "</td>
                  </tr>";
            $totalCost += (float)$cost;
        }

        // Display the total cost for the last month
        echo "<tr>
                <td class='title' colspan='2'>Total</td>
                <td class='title' style='color: red; font-weight: bold;'>" . number_format($totalCost, 2) . "</td>
                <td class='title'></td>
              </tr>";

        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>
