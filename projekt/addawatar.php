<?php
require("menu.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj awatar</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <h1>Dodaj awatar</h1>

    <?php 
    $id = $_SESSION["id"];
    $sql = "SELECT id, awatar FROM uzytkownicy WHERE id=$id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_object()) { ?>
        <form action="awatar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row->id ?>">
            <p>
                Awatar: <input type="file" name="awatar">
            </p>
            <p>
                <input type="submit" value="Dodaj awatar">
            </p>
        </form>
    <?php } 
    $conn->close();
    ?>
    
    <p><a href="index.php">Powrót do strony głównej</a></p>
</body>
</html>