<?php



$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "software";

$conn = new mysqli($servername,$username,$password,$dbname);

$rowID = $_POST['updateBtn'];

$data = query("SELECT * FROM bugs WHERE ID=".$rowID);

echo "<tr><td>".$row["ID"].
    "</td><td>".$row["ProductName"].
    "</td><td>".$row["ProductVersion"].
    "</td><td>".$row["OperatingEnvironment"].
    "</td><td>".$row["OperatingSystem"].
    "</td><td>".$row["BugFrequency"].
    "</td><td>".$row["Solutions"]."</td></tr>";