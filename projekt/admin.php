<?php
require("menu.php");

$sql = "SELECT z.id, u.login, z.tresc, z.data FROM zgłoszenia z JOIN uzytkownicy u ON z.idUzytkownika = u.id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zgłoszenia</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <div class="rajdulu">
    <table>
        <tr>
            <th>Użytkownik</th>
            <th>Treść</th>
            <th>Data</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['login'] ?></td>
                <td><?= $row['tresc'] ?></td>
                <td><?= $row['data'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
        </div>
</body>
</html>
