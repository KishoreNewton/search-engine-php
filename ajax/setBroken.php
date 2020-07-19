<?php
require_once("../config.php");

if(isset($_POST["src"])){
    $query = $con->prepare("UPDATE images SET broken = 1 WHERE imageUrl=:src");
    $src = $_POST["src"];
    $query->bindParam(":src", $src);
    $query->execute();
} else  {
    echo "No link passes";
}
?>