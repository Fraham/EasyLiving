<?php
require_once "../src/connect.php";

$residents = "";

$houseID = $_SESSION['house_id'];

$statement = "SELECT U.email, H.dName FROM users as U
    INNER JOIN user_households as UH
    ON UH.userID = U.userID
    INNER JOIN house as H
    ON U.currentHousehold = H.houseID
    WHERE	UH.houseID = $houseID";

$result = $conn->query($statement);

if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $residents .= "<tbody>";
    $residents .= "<tr class='odd gradeX'>";
    $residents .= "<td class='center'> $row[email] </td>";
    $residents .= "<td class='center'> $row[dName] </td>";
    $residents .= "</tr>";
    $residents .= "</tbody>";
  }
}

$conn->close();
echo $residents;
?>
