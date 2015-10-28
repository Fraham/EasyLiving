<?php
require "../src/connect.php";

function getTemp($spotID){
  require "../src/connect.php";
  $temp = "n/a";

  $statementT = "SELECT temperature FROM temperaturelog
WHERE spotID = $spotID
ORDER BY date ASC
LIMIT 1";

  $result = mysqli_query($conn,$statementT);
  
  //if ($result->num_rows > 0)
  //{
    while($row = mysqli_fetch_row($result)){
    
    $temp = $row[temperature];
  }
  $conn->close();
  return $temp;
}

$spots = "";

$statement = "SELECT S.spotID, S.zone FROM spots as S " ;

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $temp = getTemp($row["spotID"]);
    $spots .= "<tbody>";
    $spots .= "<tr class='odd gradeX'>";
    $spots .= "<td class='center'> $row[spotID] </td>";
    $spots .= "<td class='center'> $row[zone] </td>";
    $spots .= "<td class='center'> 0 </td>";
    $spots .= "<td class='center'> $temp </td>";
    $spots .= "<td class='center'> <button class='btn btn-danger data-toggle='modal' data-target='#myModal'>History</button> </td>";
    
    
    $spots .= "</tr>";
    $spots .= "</tbody>";
  }
}

$conn->close();
echo $spots;


?>