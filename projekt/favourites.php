<?php
require("menu.php");

$idUzytkownika = $_SESSION["id"];
$sql = "SELECT r.id, r.nazwa FROM rajdy r, ulubione u WHERE u.idRajdu = r.id AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ulubione</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    
    <h1 class="naglowek">Ulubione Rajdy</h1>
    <table>
        <?php while ($row = $result->fetch_object()): ?>
            <div class='rajdulu'>
            <tr>
            <?php echo "<h1>{$row->nazwa}</h1>"; ?>
                <?php echo " <a  href='details.php?id={$row->id}'><img class='miecz' src='sicon.png'></a><br>"; ?>
        </div>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
