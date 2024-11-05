<?php
require("menu.php");

$idUzytkownika = $_SESSION["id"];
$sql = "SELECT r.id, r.nazwa AS nazwa, r.opis AS opisr, k.nazwa AS nazwaKat, s.nazwa AS str, recommended_ip, s.typ AS typ
        FROM rajdy r
        INNER JOIN rajd u ON u.idRajdu = r.id
        INNER JOIN strefy s ON r.idStrefy = s.id
        INNER JOIN kategorie k ON r.idKategorii = k.id
        WHERE u.idUzytkownika = $idUzytkownika";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zapisane</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <div class="naglowek">
    <h1>Rajdy</h1>
</div>
    <div class='rajdul'>
        <?php while ($row = $result->fetch_object()): ?>
            <div class='rajdulu'>
                <?php 
                
                echo "<h1>{$row->nazwa}</h1>";
                echo "<img id='ikona' src='obrazki/{$row->typ}' width='150'>";
                echo "<p>Opis: {$row->opisr}</p>";
                echo "<p>Kategoria: {$row->nazwaKat}</p>";
                echo "<p>Strefa: {$row->str}</p>";
                echo "<p>Wymagane ip: {$row->recommended_ip} </p>";
                
                ?>
                </div>
                
        <?php endwhile; ?>
        </div>
       
</body>
</html>
