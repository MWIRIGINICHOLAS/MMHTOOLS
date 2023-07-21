<?php
// Include the database connection file
require_once 'db_connection.php';

// Prepare the SQL query
$sql = "SELECT * FROM patient_census ORDER BY date ASC";

// Execute the query
$result = mysqli_query($connection, $sql);

// Display the records on a web form
if (mysqli_num_rows($result) > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
                margin: 2.5rem;
            }
            th {
                border: 1px solid black;
                padding: 5px;
                text-align: center;
                background-color: skyblue;
            }
            td {
                border: 1px solid black;
                padding: 5px;
                text-align: right;
            }
            th.title {
                text-align: center;
                background-color: white;
                white-space: nowrap;
            }
            .census-dates {
                text-align: left;
                background-color:#FFC0CB;
                padding-top: 1.5rem;
            }
            tr:nth-child(even) {
                background-color: grey;
            }
            .date-column {
                min-width: 90px;
                text-align: left;
                padding: 5px;
            }
         </style>";

    echo "<table>";
    echo "<tr>
            <th colspan='37' class='title'>PATIENT CENSUS REPORT</th>
          </tr>";

    // Group headers
    echo "<tr>
            <th colspan='1'>Date</th>
            <th colspan='5'>Admissions</th>
            <th colspan='6'>NHIF</th>
            <th colspan='5'>Other Insurance</th>
            <th colspan='6'>Cash</th>
            <th colspan='1'>Safe</th>
            <th colspan='1'>Res</th>
            <th colspan='5'>Discharge In</th>
            <th colspan='5'>Releases</th>
            <th>Total Points</th>
          </tr>";

    // Column headers
    echo "<tr>
            <th class='date-column'>Date</th>

            <th>mat</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>mat</th>
            <th>nu</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>mat</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>mat</th>
            <th>nu</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>safe</th>

            <th>res</th>

            <th>mat</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>mat</th>
            <th>fw</th>
            <th>mw</th>
            <th>chw</th>
            <th>hdu</th>

            <th>total</th>
          </tr>";

    $currentMonth = '';
    $row_count = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $date = date('F Y', strtotime($row['date'])); // Get the month and year from the date

        // Display month header if it has changed
        if ($currentMonth !== $date) {
            $currentMonth = $date;
            echo "<tr>
                    <td colspan='37' class='census-dates'><strong>$currentMonth</strong></td>
                  </tr>";
        }

        // Display record
        echo "<tr>
                <td class='date-column'>" . $row['date'] . "</td>
                <td>" . $row['adm_mat'] . "</td>
                <td>" . $row['adm_fw'] . "</td>
                <td>" . $row['adm_mw'] . "</td>
                <td>" . $row['adm_chw'] . "</td>
                <td>" . $row['adm_hdu'] . "</td>
                <td>" . $row['nhif_mat'] . "</td>
                <td>" . $row['nhif_nu'] . "</td>
                <td>" . $row['nhif_fw'] . "</td>
                <td>" . $row['nhif_mw'] . "</td>
                <td>" . $row['nhif_chw'] . "</td>
                <td>" . $row['nhif_hdu'] . "</td>
                <td>" . $row['ins_mat'] . "</td>
                <td>" . $row['ins_fw'] . "</td>
                <td>" . $row['ins_mw'] . "</td>
                <td>" . $row['ins_chw'] . "</td>
                <td>" . $row['ins_hdu'] . "</td>
                <td>" . $row['cash_mat'] . "</td>
                <td>" . $row['cash_nu'] . "</td>
                <td>" . $row['cash_fw'] . "</td>
                <td>" . $row['cash_mw'] . "</td>
                <td>" . $row['cash_chw'] . "</td>
                <td>" . $row['cash_hdu'] . "</td>
                <td>" . $row['safe'] . "</td>
                <td>" . $row['res_mothers'] . "</td>
                <td>" . $row['dis_In_mat'] . "</td>
                <td>" . $row['dis_In_fw'] . "</td>
                <td>" . $row['dis_In_mw'] . "</td>
                <td>" . $row['dis_In_chw'] . "</td>
                <td>" . $row['dis_In_hdu'] . "</td>
                <td>" . $row['relmat'] . "</td>
                <td>" . $row['relfw'] . "</td>
                <td>" . $row['relmw'] . "</td>
                <td>" . $row['relchw'] . "</td>
                <td>" . $row['relhdu'] . "</td>
                <td>" . $row['totalpoints'] . "</td>
              </tr>";
    }

    echo "</table>";

    // Export button
    echo "<form action='export_excel.php' method='POST'>
              <button type='submit' name='export_excel'>Export to Excel</button>
          </form>";
} else {
    echo "No records found.";
}
?>
