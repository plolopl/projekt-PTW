<?php
 require ("session.php");
 require("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albion Online Party Finder</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
    <header></header>
    <nav>
        <p class="nagl">Albion Online Party Finder</p>
        <p id="powitanie">Użytkownik <?= $_SESSION["login"] ?> jest zalogowany</p>
        <?php
    $id = $_SESSION["id"];
    $sql = "SELECT awatar, id FROM uzytkownicy WHERE id=$id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_object()) {
        
    echo "<a href='addawatar.php' ><img id='ikona' src='obrazki/{$row->awatar}' width='40'></a>";
    }
    ?>
        <a href="favourites.php">Ulubione</a>
        <a href="zapisane.php">Moje Rajdy</a>
        <a href="myReviews.php">Moje recenzje</a>
        <?php 
     if ($_SESSION['rola'] == 'admin'){
        echo "<a href='admin.php'>Zgłoszenia</a>";
    }
    ?>
        <a href="logout.php">Wyloguj</a>
    
   
    </nav>
    <div class="container">
    <aside class="filter-column">
    <div class="filtry">
        <form method="GET" action="">
            Rajd:
            <select name="idKat" id="category-select">
                <option value="">Wybierz kategorię</option> <!-- Pusta opcja, która pozwala nie wybierać kategorii -->
                <?php
                $sql = "SELECT id, nazwa from kategorie";
                $result = $conn->query($sql);
                while ($cat = $result->fetch_object()) {
                    // Sprawdzamy, czy ta opcja została wybrana
                    $selected = isset($_GET['idKat']) && $_GET['idKat'] == $cat->id ? 'selected' : '';
                    echo "<option value='$cat->id' $selected>$cat->nazwa</option>";
                }
                ?>
            </select>
            <br>
            Strefa:
            <select name="idStrefy" id="zone-select">
                <option value="">Wybierz strefę</option> <!-- Pusta opcja, która pozwala nie wybierać strefy -->
                <?php
                $sql = "SELECT id, nazwa from strefy";
                $result = $conn->query($sql);
                while ($zone = $result->fetch_object()) {
                    // Sprawdzamy, czy ta opcja została wybrana
                    $selected = isset($_GET['idStrefy']) && $_GET['idStrefy'] == $zone->id ? 'selected' : '';
                    echo "<option value='$zone->id' $selected>$zone->nazwa</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" value="Ustaw filtry">
            <a href="index.php" class="clear-filters-btn">Wyczyść filtry</a> 
        </form>
    </div>
</aside>

        <section class="content-area">
            <form class="search-bar">
                <input type="text" name="fraza" placeholder="Wyszukaj">
                <input type="submit" value="Wyszukaj">
                <a href="index.php" class="wyczysc">Anuluj</a> 

            </form>

            <div class="rajd-list">
            <?php
$sql = "SELECT r.id AS id, r.nazwa AS nazwa, k.nazwa as kat, ileOsob, s.nazwa AS tekst, r.opis, s.typ AS typ 
        FROM rajdy r
        JOIN kategorie k ON r.idKategorii = k.id
        JOIN strefy s ON r.idStrefy = s.id";
$whereClauses = [];

if (isset($_GET["idKat"]) && !empty($_GET["idKat"])) {
    $idKat = intval($_GET["idKat"]);
    $whereClauses[] = "r.idKategorii = $idKat";
}

if (isset($_GET["idStrefy"]) && !empty($_GET["idStrefy"])) {
    $idStrefy = intval($_GET["idStrefy"]);
    $whereClauses[] = "r.idStrefy = $idStrefy";
}

if (isset($_GET["fraza"]) && !empty($_GET["fraza"])) {
    $fraza = $conn->real_escape_string($_GET["fraza"]);
    $whereClauses[] = "r.nazwa LIKE '%$fraza%'";
}

if (!empty($whereClauses)) {
    $sql .= " WHERE " . implode(" AND ", $whereClauses);
}

$result = $conn->query($sql);

while ($row = $result->fetch_object()) {
    echo "<div class='rajd-item'>
            <img class='ikona' src='obrazki/{$row->typ}' alt='{$row->tekst}'>
            <h2>{$row->kat}</h2>
            <div class='rajd-details'>
                <h2>{$row->nazwa}</h2>
                <p>{$row->opis}</p>
                <a class='more' href='details.php?id={$row->id}'>Czytaj więcej</a>
            </div>
          </div>";
}
?>
            </div>
        </section>
    </div>

    <a href="insertForm.php" class="floating-button">+</a>

    <footer>
        <p class="nagl">Albion Online Party Finder</p>
        <p>Źródła:</p>
        <p>
            <a href="https://albiononline.com/home">Oficjalna strona</a>
            <a href="https://albiononline2d.com">Fanowskie wiki</a>
            <a href="https://wiki.albiononline.com/wiki/Albion_Online_Wiki">Oficjalne wiki</a>
        </p>
        <form action="submitReport.php" method="post">
    <input type="text" name="tresc" placeholder="Zgłoś problem">
    <button type="submit">Wyślij</button>
</form>
    </footer>
</body>
</html>