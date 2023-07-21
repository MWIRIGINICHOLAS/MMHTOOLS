<?php
// Include the database connection file
require_once 'db_connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['VehicleID'])) {
        $VehicleID = $_POST['VehicleID'];

        // Include the necessary files
        require_once 'db_connection.php';

        // Prepare the SQL query with the VehicleID
        $sql = "SELECT Date, VehicleID, Cost, Source FROM fuel WHERE VehicleID = '$VehicleID' ORDER BY Date DESC";

        // Execute the query
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Create a file pointer with write access
            $file = fopen('exported_data.csv', 'w');

            // Write the column headers to the file
            $headers = ['Date', 'VehicleID', 'Cost', 'Source'];
            fputcsv($file, $headers);

            // Write the data rows to the file
            while ($row = mysqli_fetch_assoc($result)) {
                $rowData = [$row['Date'], $row['VehicleID'], $row['Cost'], $row['Source']];
                fputcsv($file, $rowData);
            }

            // Close the file pointer
            fclose($file);

            // Set the appropriate headers for file download
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="exported_data.csv"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('exported_data.csv'));

            // Flush the output buffer and send the file to the user
            ob_clean();
            flush();
            readfile('exported_data.csv');

            // Delete the temporary file
            unlink('exported_data.csv');

            exit;
        } else {
            echo "No records found.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request.";
}
?>







