<?php include ('fleet_management_header.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Display Records</title>
    <style>
        .vehicle-box {
            border: 1px solid black;
            padding: 10px;
            margin-bottom: 10px;
        }

        .vehicle-title {
            font-weight: bold;
        }

        .vehicle-details {
            margin-left: 20px;
            list-style-type: none;
            padding: 0;
        }

        .vehicle-details li strong {
            display: inline-block;
            width: 150px;
        }

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
                $sql = "SELECT DISTINCT VehicleID FROM vehicledetails ORDER BY VehicleID ASC";
                $result = mysqli_query($connection, $sql);

                // Display the VehicleIDs in the dropdown list
                while ($row = mysqli_fetch_assoc($result)) {
                    $vehicleID = $row['VehicleID'];
                    echo "<option value='" . htmlspecialchars($vehicleID) . "'>" . htmlspecialchars($vehicleID) . "</option>";
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
    // Retrieve the selected vehicle from the form
    $vehicleID = $_POST['VehicleID'];

    // Prepare the SQL query
    $sql = "SELECT * FROM vehicledetails WHERE VehicleID = '$vehicleID'";

    // Execute the query
    $result = mysqli_query($connection, $sql);

    // Display the records on a web form
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $vehicleDriverID = $row['DriverID'];
            $vehicleType = $row['Type'];
            $vehicleMake = $row['Make'];
            $vehicleColour = $row['Colour'];
            $vehicleEngine = $row['Engine'];
            $vehicleChasisNo = $row['ChasisNo'];
            $vehicleManufactureYear = $row['ManufactureYear'];
            $vehicleRating = $row['Rating'];
            $vehicleSeat = $row['Seat'];
            $vehiclePurchaseDate = $row['PurchaseDate'];
            $vehicleVender = $row['Vender'];
            $vehiclePurchasePrice = $row['PurchasePrice'];
            $vehicleDuty = $row['Duty'];
            $vehicleTransmission = $row['Transmission'];
            $vehicleFuel = $row['Fuel'];
            $vehicleBatteryDetail = $row['BatteryDeta'];
            $vehicleTyreDetail = $row['TyreDetail'];
            $vehicleTools = $row['Tools'];
            $vehicleNotes = $row['Notes'];
            $vehicleDisposed = $row['Disposed'];
            $vehicleYearDisposed = $row['YearDisposed'];
            $vehicleBuyer = $row['Buyer'];
            $vehicleDisposalValue = $row['DisposalValue'];

            // Output the vehicle details within a box in a list format
            echo "<div class='vehicle-box'>";
            echo "<div class='vehicle-title'>Vehicle ID: " . htmlspecialchars($vehicleID) . "</div>";
            echo "<ul class='vehicle-details'>";
            echo "<li><strong>Driver Incharge:</strong> " . htmlspecialchars($vehicleDriverID) . "</li>";
            echo "<li><strong>Make:</strong> " . htmlspecialchars($vehicleMake) . "</li>";
            echo "<li><strong>Type:</strong> " . htmlspecialchars($vehicleType) . "</li>";
            echo "<li><strong>Colour:</strong> " . htmlspecialchars($vehicleColour) . "</li>";
            echo "<li><strong>Engine:</strong> " . htmlspecialchars($vehicleEngine) . "</li>";
            echo "<li><strong>Chasis No:</strong> " . htmlspecialchars($vehicleChasisNo) . "</li>";
            echo "<li><strong>Manufacture Year:</strong> " . htmlspecialchars($vehicleManufactureYear) . "</li>";
            echo "<li><strong>Rating:</strong> " . htmlspecialchars($vehicleRating) . "</li>";
            echo "<li><strong>Seat:</strong> " . htmlspecialchars($vehicleSeat) . "</li>";
            echo "<li><strong>Purchase Date:</strong> " . htmlspecialchars($vehiclePurchaseDate) . "</li>";
            echo "<li><strong>Vender:</strong> " . htmlspecialchars($vehicleVender) . "</li>";
            echo "<li><strong>Purchase Price:</strong> " . htmlspecialchars($vehiclePurchasePrice) . "</li>";
            echo "<li><strong>Duty:</strong> " . htmlspecialchars($vehicleDuty) . "</li>";
            echo "<li><strong>Transmission:</strong> " . htmlspecialchars($vehicleTransmission) . "</li>";
            echo "<li><strong>Fuel:</strong> " . htmlspecialchars($vehicleFuel) . "</li>";
            echo "<li><strong>Battery Details:</strong> " . htmlspecialchars($vehicleBatteryDetail) . "</li>";
            echo "<li><strong>Tyre Details:</strong> " . htmlspecialchars($vehicleTyreDetail) . "</li>";
            echo "<li><strong>Tools:</strong> " . htmlspecialchars($vehicleTools) . "</li>";
            echo "<li><strong>Notes:</strong> " . htmlspecialchars($vehicleNotes) . "</li>";
            echo "<li><strong>Disposed:</strong> " . htmlspecialchars($vehicleDisposed) . "</li>";
            echo "<li><strong>Year Disposed:</strong> " . htmlspecialchars($vehicleYearDisposed) . "</li>";
            echo "<li><strong>Buyer:</strong> " . htmlspecialchars($vehicleBuyer) . "</li>";
            echo "<li><strong>Disposal Value:</strong> " . htmlspecialchars($vehicleDisposalValue) . "</li>";
            echo "</ul>";
            echo "</div>";
        }
    } else {
        echo "No records found.";
    }
}
?>
