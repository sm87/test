<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Задание 1</title>
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

$sql = "SELECT * FROM task1";
$result = $conn->query($sql);

function filter($rawPhone) {
    if (strlen($rawPhone) == 0)
        return FALSE;

    $phone = preg_replace("/[^0-9+]/", "", $rawPhone);
    if (strlen($phone) == 0)
        return FALSE;

    if (($phone[0] == '8' || $phone[0] == '7')) {
        if (strlen($phone) > 10) {
            $phone[0] = '7';
            $phone = "+".$phone;
        } else {
            $phone = "+7".$phone;
        }
    } else if ($phone[0] == "9") {
        $phone = "+7".$phone;
    } else if ($phone[0] != "+"){
        $phone = "+".$phone;
    }

    return $phone;
}


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $phone = filter($row["Phone"]);

        if ($phone)
            echo "<tr><td>".$phone."</td></tr>";
    }
}

$conn->close();
?>
    </table>
  </body>
</html>