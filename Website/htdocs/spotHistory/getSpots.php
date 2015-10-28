<?php
require "../src/connect.php";

function getHistory($spotID){
		require "../src/connect.php";


		$statement = "SELECT S.spotID, I.date, I.interaction FROM spots as S 
                 LEFT OUTER JOIN interactionlog as I
                  ON I.spotID = S.spotID
                  WHERE S.spotID = $spotID
                 ORDER BY I.date DESC";

		$result = $conn->query($statement);

		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
          $spots .= "<tbody>";
          $spots .= "<tr class='odd gradeX'>";
          $spots .= "<td class='center'> $row[spotID] </td>";
          $spots .= "<td class='center'> $row[zone] </td>";
          $spots .= "<td class='center'> 0 </td>";
          $spots .= "<td class='center'> $temp </td>";
          $spots .= "<td class='center'> <button type='button' class='btn btn-danger btn-block' data-toggle='modal' data-target='#$row[spotID]'>History</button> </td>";
          
          
          $spots .= "</tr>";
          $spots .= "</tbody>";
			}
		}
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
        
                  <table class='table table-striped' id='tblGrid'>
            <thead id='tblHead'>
              <tr>
                <th>Location</th>
                <th>Points</th>
                <th class='text-right'>Mean</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Long Island, NY, USA</td>
                <td>3</td>
                <td class='text-right'>45001</td>
              </tr>
              <tr><td>Chicago, Illinois, USA</td>
                <td>5</td>
                <td class='text-right'>76455</td>
              </tr>
              <tr><td>New York, New York, USA</td>
                <td>10</td>
                <td class='text-right'>39097</td>
              </tr>
            </tbody>
            </table>";
          
          
				
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
}

$conn->close();
echo $spots;


?>