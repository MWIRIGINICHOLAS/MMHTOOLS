<!DOCTYPE html>
<html>
<?php include ('fleet_management_header.php') ?>
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
            <select id="DriverID" name="DriverID">
			<option disabled selected>Select Driver</option>
                <?php
                // Include the database connection file
                require_once 'db_connection.php';

                // Retrieve all DriverIDs from the table
                $sql = "SELECT DISTINCT DriverID FROM journeys ORDER BY DriverID ASC";
                $result = mysqli_query($connection, $sql);

                // Display the DriverIDs in the dropdown list
                while ($row = mysqli_fetch_assoc($result)) {
                    $DriverID = $row['DriverID'];
                    echo "<option value='" . htmlspecialchars($DriverID) . "'>" . htmlspecialchars($DriverID) . "</option>";
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
    $DriverID = $_POST['DriverID'];

    // Prepare the SQL query
    $sql = "SELECT Date, DriverID, VehicleID, `Purpose of Journey` FROM journeys";

    // Add condition based on the selected driver
    if (!empty($DriverID)) {
        $sql .= " WHERE DriverID = ?";
    }

    // Add order by clause
    $sql .= " ORDER BY Date DESC";

    // Prepare the statement
    $stmt = mysqli_prepare($connection, $sql);

    // Bind the parameter if driver is selected
    if (!empty($DriverID)) {
        mysqli_stmt_bind_param($stmt, "s", $DriverID);
    }

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Display the records on a web form
    if (mysqli_num_rows($result) > 0) {
        echo "<style>
                table {
                    border-collapse: collapse;
                    text-align:center;
                    margin: 2.5rem 10rem;
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
                    <td>" . htmlspecialchars($row['Date']) . "</td>
                    <td>" . htmlspecialchars($row['DriverID']) . "</td>
                    <td>" . htmlspecialchars($row['VehicleID']) . "</td>
                    <td>" . htmlspecialchars($row['Purpose of Journey']) . "</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>
