<?php
require("menu.php");

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$idUzytkownika = $_SESSION["id"];
$sql1 = "SELECT id FROM ulubione WHERE idRajdu = $id AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql1);
$added = $result->num_rows > 0;
$text = $added ? "out.jpg" : "add.jpg";

$sql2 = "SELECT id FROM rajd WHERE idRajdu = $id AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql2);
$added2 = $result->num_rows > 0;
$text2 = $added2 ? "usun.png" : "dodaj.jpg";
$sql3 = "SELECT id FROM rajd WHERE idRajdu = $id";
$result = $conn->query($sql3);
$ile = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szczegóły rajdu</title>
    <link rel="stylesheet" href="glowne.css">
</head>
<body>


<div class="szczeg">
<div class="rajdulu">
    <?php
    $sql = "SELECT idKategorii, k.nazwa AS nazwaKat, r.nazwa, r.opis, ileOsob, s.typ AS typ,s.id ,s.nazwa AS str,
    idStrefy, recommended_ip FROM rajdy r, kategorie k, strefy s WHERE r.id=$id AND idKategorii=k.id AND idStrefy=s.id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_object()) {
        
        
        echo "<h1>{$row->nazwa}</h1>";
        echo "<img id='ikona' src='obrazki/{$row->typ}' width='150'>";
        echo "<p>Opis: {$row->opis}</p>";
        echo " <p>Kategoria: {$row->nazwaKat}</p>";
        echo "<p>Strefa: {$row->str}</p>";
        echo "<p>Ilosc osob: $ile / {$row->ileOsob} </p>";
        echo "<p>Wymagane ip: {$row->recommended_ip} </p>";
        echo "<p><a href='updateForm.php?id=$id'>Edytuj Rajd</a></p>";
        echo "<p><a href='delete.php?id=$id'>Usuń Rajd</a></p>";
        ?><p class='fav' data-rajd='<?=$id?>'>
        <img src='<?=$text?>' alt= '<?=$text?>' width='50'>
        </p>
        <p class='add' data-rajd='<?=$id?>'>
        <img src='<?=$text2?>' alt= '<?=$text2?>' width='50'>
        </p>
        <?php
    } else {
        echo "Rajd o podanym ID nie istnieje.";
    }

    ?>
    
    </div>
    </div>
    <h1>Uczestnicy rajdu: </h1>
    <div class="rajdulu">
    <?php
     $sql = "SELECT r.id , p.idUzytkownika, p.idRajdu ,u.awatar AS awatar , u.login as logi, u.id, u.email as email
     FROM rajd p, uzytkownicy u, rajdy r WHERE r.id=$id AND p.idRajdu=r.id AND u.id = p.idUzytkownika";
     $result = $conn->query($sql);

     if ($row = $result->fetch_object()) {
         
         
         echo "<h1>Nick: {$row->logi}</h1>";
         echo "<img id='ikona' src='obrazki/{$row->awatar}' width='50'>";
         echo "<p>Email: {$row->email}</p>";
         
         
     } else {
         echo "Rajd nie ma zapisanych osob";
     }
 
     ?>
    </div>

    <p><a href="index.php">Powrót do strony głównej</a></p>
    <form action="/action_page.php">
</form>
<form action="insertreview.php">
<h1>
    Recenzja
</h1>
<p>Użytkownik</p>
<input type="hidden" name="idRajdu" id="idRajdu" readonly value="<?=$id?>">
<input type="text" name="username" id="username" readonly value="<?=$_SESSION['login']?>">
<p>Ocena</p>
<input type="number" name="ocena" id="ocena">
<p>Opinia</p>
<input type="text" name="tresc" id="tresc">
<input type="submit" value="Dodaj">
<?php
$sql = "SELECT nick, ocena, tresc, data FROM recenzje WHERE idRajdu=$id";
$res=$conn->query($sql);
while($row = $res->fetch_object()){
    echo "<p>$row->nick $row->ocena $row->tresc</p>";}
?>

</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
