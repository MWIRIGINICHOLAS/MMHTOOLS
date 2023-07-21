<!DOCTYPE html>
<html>

<head>
    <title>Display Records</title>
	<style>
	  form{
		  text-align:center;
		  marigin:2rem 5rem;
		  padding:2rem 5rem;
		  font-size:2rem;
	  }
    form input{
			font-size:1.2rem;
            height:auto;			
		  }
   form button{
			font-size:18px;
            height:2rem;
            width:7rem;			
		  }
		  form input,
         form select,
          form button {
        font-size: 1.2rem;
         height: 2rem;
         padding: 0.3rem;
        box-sizing: border-box;
            }
	  
	  .forms{
		  color:maroon;
		  background-color:skyblue;
	      margin:1rem 7rem;
		 
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
    $sql = "SELECT * FROM patient_census WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date ASC";

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
                    width: auto;
                    text-align: center;
                    background-color: skyblue;
                }
                td {
                    border: 1px solid black;
                    padding: 5px;
                    width: auto;
                    text-align: right;
                }
                th.title {
                    text-align: center;
                    background-color: white;
                    width: auto;
                }
                .census-dates {
                    text-align: left;
                    background-color:#FFC0CB;
                    padding-top:1.5rem;
                }
                tr:nth-child(even) {
                    background-color: grey;
                }
                .date-column {
                    width: 200px; /* Adjust the width as needed */
                    text-align: left;
                    pading:5px;
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
    } else {
        echo "No records found.";
    }
}
?>


