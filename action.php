<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "datacsv2";

$conn = mysqli_connect($servername, $username, $password, $db);

if (isset($_POST["Import"])) {

    $filename = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($filename, "r");
        $bug = 0;

        fgetcsv($file);
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $bug++;
            if ($getData[0] !== '') {
                $sql = "INSERT INTO datacsv (InvoiceNo, StockCode, Description, Quantity, InvoiceDate, UnitPrice, CustomerID, Country) VALUES ('$getData[0]', '$getData[1]', '$getData[2]', '$getData[3]', '$getData[4]', '$getData[5]', '$getData[6]', '$getData[7]')";
                $result = mysqli_query($conn, $sql);
            }
        }

        fclose($file);
        echo "<h1>CSV file upload successfully .....!</h1>";
    }
}
