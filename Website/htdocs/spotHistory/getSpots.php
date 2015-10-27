<?php
require_once "../src/connect.php";

$spots = "";

$statement = "SELECT S.spotID, S.zone FROM spots as S " ;

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
    $spots .= "<td class='center'> 0 </td>";
    $spots .= "<td class='center'> <button>History</button> </td>";
    
    
    $spots .= "</tr>";
    $spots .= "</tbody>";
  }
}

$conn->close();
echo $spots;
?>