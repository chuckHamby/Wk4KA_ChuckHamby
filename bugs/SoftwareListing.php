<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "software";

$conn = new mysqli($servername,$username,$password,$dbname);

$sqlStatement = "Select * From bugs";
$result = $conn->query($sqlStatement);

echo "<h1>Bug Report Listings</h1>";

if ($result->num_rows > 0){
    echo"<table>".
        "<tr>".
            "<th><label>ID:</label></th>".
            "<th><label>Product Name:</label></th>".
            "<th><label>Product Version:</label></th>".
            "<th><label>Operating Environment:</label></th>".
            "<th><label>Operating System:</label></th>".
            "<th><label>Bug Frequency:</label></th>".
            "<th><label>Proposed Solutions:</label></th>".
        "</tr>";

    while($row = $result->fetch_assoc()){
        echo "<tr><td>".$row["ID"].
             "</td><td>".$row["ProductName"].
             "</td><td>".$row["ProductVersion"].
             "</td><td>".$row["OperatingEnvironment"].
             "</td><td>".$row["OperatingSystem"].
             "</td><td>".$row["BugFrequency"].
             "</td><td>".$row["Solutions"]."</td></tr>";
    }
}
?>

</table>
</br>
<form action="SoftwareUpdate.php" method="post" enctype="multipart/form-data">
    <h3>To update a bug report enter ID and click Update:</h3>
    <input type="text" id="rowID" name="rowID" value=""/>
    <input type="submit" name="updateBtn" value=".$rowID.">Update</input>
</form>