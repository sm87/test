<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Задание 2</title>
    <style type="text/css">
        body { font-family:courier }
    </style>
  </head>
  <body>
    <table>
<?php
require "../config.php";

$conn = new mysqli($arrConfig["dbhost"], $arrConfig["dbuser"], $arrConfig["dbpass"], $arrConfig["dbname"]);

mysqli_set_charset($conn, $arrConfig["dbcharset"]);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, Date, Phone, Name FROM task2 ORDER BY case when name = 'Дмитрий' then 1 else 0 end, Phone DESC, Date DESC";
$result = $conn->query($sql);

echo "<tr><th>id</th><th>Date</th><th>Phone</th><th>Name</th></tr>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["Date"]."</td><td>".$row["Phone"]."</td><td>".$row["Name"]."</td></tr>";
    }
}

$conn->close();
?>
    </table>
  </body>
</html>