<?php
$conn = new mysqli("localhost", "root", "", "projekt");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$kategoria = $_POST["category"];
$idStrefy = $_POST["strefa"];
$ileOsob = $_POST["ileOsob"];
$recommended_ip = $_POST["recommended_ip"];

$sql = "INSERT INTO rajdy VALUES ('','$kategoria','$nazwa','$opis', '$ileOsob', $idStrefy, $recommended_ip)";
if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
