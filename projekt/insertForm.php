<?php
 require ("session.php");
 require("connection.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj rajd</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>
<header>
</header>
<nav>
<p class="nagl">Albion Online Party Finder
</p>
<p>
 <p id="powitanie" >Użytkownik <?= $_SESSION["login"]?> jest zalogowany</p><br><br>
 <a href="favourites.php">Ulubione</a>
 <a href="myReviews.php">Moje recenzje</a>
 <a href="logout.php">Wyloguj</a>
</p>
</nav>
    <h1>
        Dodaj rajd
</h1>
    <form action="insert.php" method="post">
        <p>
            Nazwa: <input type="text" name="nazwa" required>
        </p>
        
        <p>
        Kategoria: <select name="category" id="cat">
        <?php
         $sql = "SELECT id, nazwa from kategorie";
         $result = $conn->query($sql);
         while($cat=$result->fetch_object()){
         echo "<option value='$cat->id'>$cat->nazwa</option>";
         }
        ?>
        </select>
        </p>
        <p>
        Strefa: <select name="strefa" id="st">
        <?php
         $sql1 = "SELECT id, nazwa from strefy";
         $result = $conn->query($sql1);
         while($st=$result->fetch_object()){
         echo "<option value='$st->id'>$st->nazwa</option>";
         }
         $conn->close();
        ?>
        </select>
        </p>
        
        <p>
            Opis: <textarea name="opis" cols="30" rows="10" required></textarea>
        </p>
       
        <p>
            ilość osób: <input type="number" name="ileOsob" required>
        </p>
        <p>
            Wymagane ip: <input type="number" name="recommended_ip" required>
        </p>
        <p>
            <input type="submit" value="Dodaj rajd">
        </p>
    </form>
    <p><a href="index.php">Powrót do strony głównej</a></p>
</body>
</html>
