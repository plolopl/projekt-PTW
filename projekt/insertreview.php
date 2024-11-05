<?php
 require ("session.php");
 require("connection.php");
 $login = $_SESSION["login"];
 $NULL=NULL;
 $idRajdu = $_GET['idRajdu'];
 $ocena = $_GET['ocena'];
 $tresc = $_GET['tresc'];
 if(isset($tresc)&&isset($ocena)){
    $sql = "INSERT INTO  recenzje (id,idRajdu,nick,ocena,tresc) VALUES ('','$idRajdu','$login','$ocena','$tresc')";
    $conn->query($sql);
 }
 if ($conn->query($sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>