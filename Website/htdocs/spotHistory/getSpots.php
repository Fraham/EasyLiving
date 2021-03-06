<?php
require "../src/connect.php";

function getHistory($spotID){
		require "../src/connect.php";

    $spot = "";

		$statement2 = "SELECT I.date, COUNT(*) as data FROM spots as S 
                 LEFT OUTER JOIN log2 as I
                  ON I.spotID = S.spotID
                  WHERE S.spotID = '$spotID'
                  GROUP BY 
                  			YEAR(I.date),
                        MONTH(I.date),
                        DAY(I.date),
                        HOUR(I.date),
                        MINUTE(I.date)
                 ORDER BY I.date DESC";

		$result2 = $conn->query($statement2);

		if ($result2->num_rows > 0)
		{
			while($row = $result2->fetch_assoc())
			{
          $spot .= "<div>
          <p style='margin-right:1.25em; text-align:center;'>$row[data] <span style='padding:100px;'>$row[date]</p>
          </div>";
			}
		}
    return $spot;
}

$spots = "";

$statement = "SELECT S.spotID, S.zone FROM spots as S " ;

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $temp = 0 ;//getTemp($row["spotID"]);
    $spots .= "<tbody>";
    $spots .= "<tr class='odd gradeX'>";
    $spots .= "<td class='center'> $row[spotID] </td>";
    $spots .= "<td class='center'> $row[zone] </td>";
    $spots .= "<td class='center'> 0 </td>";
    $spots .= "<td class='center'> $temp </td>";
    $spots .= "<td class='center'> <button type='button' class='btn btn-danger btn-block' data-toggle='modal' data-target='#$row[spotID]'>History</button> </td>";
    
    
    $spots .= "</tr>";
    $spots .= "</tbody>";
    $spots .= "		<!-- Modal -->
		<div class='modal fade' id='$row[spotID]' role='dialog'>
			<div class='modal-dialog'>
			
			<!-- Modal content-->
			<div class='modal-content'>
				<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal'>&times;</button>
				<h4 class='modal-title'>$row[spotID]</h4>
				</div>
				<div class='modal-body'>
          <div>
          <h3 style='margin-right:1.25em; text-align:center;'>Interaction <span style='padding:100px;'>Date</h3></span>
          </div>";
          
          $spots .= getHistory($row['spotID']);
				
		$spots .="
        </div>
				<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
				</div>
			</div>
			
			</div>
		</div>
    ";
  }
          $conn->close(); 
}

echo $spots;


?>