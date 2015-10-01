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
    require "Phones.php";

    try {
        $phones = new Phones($arrConfig);

        $result = $phones->getPhones();

        foreach ($result as $value) {
            echo "<tr><td>" . $value . "</td></tr>";
        }

    } catch(Exception $ex)
    {
        die($ex->getMessage());
    }

    ?>
</table>
</body>
</html>