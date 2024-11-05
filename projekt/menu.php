<?php
require("session.php");
require("connection.php");
?>
<header>
</header>
<nav>
    
    <p class="nagl">Albion Online Party Finder</p>
<div class="awa">
    <p id="powitanie">Użytkownik <?= $_SESSION["login"] ?> jest zalogowany
    <?php
    $id = $_SESSION["id"];
    $sql = "SELECT awatar, id FROM uzytkownicy WHERE id=$id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_object()) {
        
    echo "<a href='addawatar.php' ><img id='ikona' src='obrazki/{$row->awatar}' width='40'></a>";
    }
    ?>
</div>
        <a href="index.php">Strona główna</a>
        <a href="favourites.php">Ulubione</a>
        <a href="zapisane.php">Moje Rajdy</a>
        <a href="myReviews.php">Moje recenzje</a>
        <a href="logout.php">Wyloguj</a>
</nav>
