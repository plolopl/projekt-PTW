<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj dzban</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <?php
    $conn = new mysqli("localhost", "root", "", "projekt");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET["id"];
    $sql = "SELECT id, nazwa, opis, ileOsob, recommended_ip FROM rajdy WHERE id=$id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_object()) {
    ?>
    <h1>Edytuj rajd</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $row->id ?>">
        <p>
            Nazwa: <input type="text" name="nazwa" value="<?= $row->nazwa ?>" required>
        </p>
        <p>
            Opis: <textarea name="opis" cols="30" rows="10" required><?= $row->opis ?></textarea>
        </p>
        <p>
            Ile Osob: <input type="number" name="ileOsob" value="<?= $row->pojemnosc ?>" required>
        </p>
        <p>
            Wymagane ip: <input type="number" name="recommended_ip" value="<?= $row->wysokosc ?>" required>
        </p>
        <p>
            <input type="submit" value="Zapisz zmiany">
        </p>
    </form>
    <?php
    } else {
        echo "Rajd o podanym ID nie istnieje.";
    }

    $conn->close();
    ?>
    <p><a href="index.php">Powrót do listy rajdow</a></p>
</body>
</html>