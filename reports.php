<?php
// Include the database connection file
require_once 'db_connection.php';

// Prepare the SQL query
$sql = "SELECT * FROM patient_census";

// Execute the query
$result = mysqli_query($connection, $sql);

// Display the records on a web form
if (mysqli_num_rows($result) > 0) {
    echo "<style>
            table {
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 5px;
                width: auto;
                text-align: right;
            }
            th.title {
                text-align: center;
            }
            .census-dates {
                text-align: left;
            }
         </style>";

    echo "<table>";
    echo "<tr>
            <th colspan='37' class='title'>PATIENT CENSUS REPORT</th>
          </tr>";

    echo "<tr>
            <th>Date</th>
            <th>adm_mat</th>
            <th>adm_fw</th>
            <th>adm_mw</th>
            <th>adm_chw</th>
            <th>adm_hdu</th>
            <th>nhif_mat</th>
            <th>nhif_nu</th>
            <th>nhif_fw</th>
            <th>nhif_mw</th>
            <th>nhif_chw</th>
            <th>nhif_hdu</th>
            <th>ins_mat</th>
            <th>ins_fw</th>
            <th>ins_mw</th>
            <th>ins_chw</th>
            <th>ins_hdu</th>
            <th>cash_mat</th>
            <th>cash_nu</th>
            <th>cash_fw</th>
            <th>cash_mw</th>
            <th>cash_chw</th>
            <th>cash_hdu</th>
            <th>safe</th>
            <th>res_mothers</th>
            <th>dis_In_mat</th>
            <th>dis_In_fw</th>
            <th>dis_In_mw</th>
            <th>dis_In_chw</th>
            <th>dis_In_hdu</th>
            <th>relmat</th>
            <th>relfw</th>
            <th>relmw</th>
            <th>relchw</th>
            <th>relhdu</th>
            <th>totalpoints</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        // Display clinic name and report header
        echo "<tr>
                <td colspan='37' class='census-date'><strong>".$row['date']."</strong></td>
              </tr>";

        echo "<tr>   
                <td>".$row['date']."</td>
                <td>".$row['adm_mat']."</td>
                <td>".$row['adm_fw']."</td>
                <td>".$row['adm_mw']."</td>
                <td>".$row['adm_chw']."</td>
                <td>".$row['adm_hdu']."</td>
                <td>".$row['nhif_mat']."</td>
                <td>".$row['nhif_nu']."</td>
                <td>".$row['nhif_fw']."</td>
                <td>".$row['nhif_mw']."</td>
                <td>".$row['nhif_chw']."</td>
                <td>".$row['nhif_hdu']."</td>
                <td>".$row['ins_mat']."</td>
                <td>".$row['ins_fw']."</td>
                <td>".$row['ins_mw']."</td>
                <td>".$row['ins_chw']."</td>
                <td>".$row['ins_hdu']."</td>
                <td>".$row['cash_mat']."</td>
                <td>".$row['cash_nu']."</td>
                <td>".$row['cash_fw']."</td>
                <td>".$row['cash_mw']."</td>
                <td>".$row['cash_chw']."</td>
                <td>".$row['cash_hdu']."</td>
                <td>".$row['safe']."</td>
                <td>".$row['res_mothers']."</td>
                <td>".$row['dis_In_mat']."</td>
                <td>".$row['dis_In_fw']."</td>
                <td>".$row['dis_In_mw']."</td>
                <td>".$row['dis_In_chw']."</td>
                <td>".$row['dis_In_hdu']."</td>
                <td>".$row['relmat']."</td>
                <td>".$row['relfw']."</td>
                <td>".$row['relmw']."</td>
                <td>".$row['relchw']."</td>
                <td>".$row['relhdu']."</td>
                <td>".$row['totalpoints']."</td>
              </tr>";
    }

    // Insert a blank row after the last clinic
    echo "<tr><td colspan='37'></td></tr>";

    echo "</table>";
} else {
    echo "No records found.";
}
?>
