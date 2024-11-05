<?php
require("session.php");
require("connection.php");

$idUzytkownika = $_SESSION["id"];
$tresc = $_POST["tresc"];

$sql = "INSERT INTO zgłoszenia (idUzytkownika, tresc) VALUES ($idUzytkownika, '$tresc')";

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    echo "sukces";
    $conn->close();
    header("Location: index.php");
}

$conn->close();
?>
