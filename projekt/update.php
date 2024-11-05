<?php
$conn = new mysqli("localhost", "root", "", "projekt");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];
$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$ileOsob = $_POST["ileOsob"];
$recommended_ip = $_POST["recommended_ip"];

$sql = "UPDATE rajdy SET nazwa='$nazwa', opis='$opis', ileOsob=$ileOsob, reccomended_ip=$reccomended_ip WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: details.php?id=$id");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>