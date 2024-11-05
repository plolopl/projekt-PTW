<?php
require("menu.php");
$login = $_SESSION["login"];
$sql = "SELECT DISTINCT ocena, tresc, data, d.id AS idDzbana, nazwa 
        FROM recenzje r 
        JOIN rajdy d ON d.id = idRajdu 
        WHERE nick = '$login'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recenzje Użytkownika</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <h1>Powrót do listy rajdow</h1> 
 <a  href="index.php"><img class='miecz' src='sicon.png'></a><br>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            echo "<div class='review'>";
            echo "<p><strong>Ocena:</strong> {$row->ocena}</p>";
            echo "<p><strong>Treść:</strong> {$row->tresc}</p>";
            echo "<p><strong>Data:</strong> {$row->data}</p>";
            echo "<p><strong>Rajd:</strong> {$row->nazwa}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>Brak recenzji do wyświetlenia.</p>";
    }
    ?>
</body>
</html>