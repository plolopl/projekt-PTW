<?php
require("session.php");
require("connection.php");

$idRajdu = $_REQUEST["idRajdu"];
$idUzytkownika = $_SESSION["id"];

$sql = "SELECT id FROM rajd WHERE idRajdu = $idRajdu AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql);

if ($result!==false&&$result->num_rows == 1) {
    $id = $result->fetch_object()->id;
    $sql = "DELETE FROM rajd WHERE id = $id";
} else {
    $sql = "INSERT INTO rajd (idRajdu, idUzytkownika) VALUES ($idRajdu, $idUzytkownika)";
}

if ($conn->query($sql) !== TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
} else {
    echo "sukces";
}

$conn->close();
?>
