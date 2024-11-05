<?php

$conn = new mysqli("localhost", "root", "", "projekt");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST["id"];
$awatar = basename($_FILES["awatar"]["name"]);
$path = "obrazki/$awatar";
if (move_uploaded_file($_FILES["awatar"]["tmp_name"], $path)) {
    $sql = "UPDATE uzytkownicy SET awatar='$awatar' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading file.";
}

$conn->close();
?>