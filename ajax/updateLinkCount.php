<?php
require_once("../config.php");

if(isset($_POST["linkId"])){
    $query = $con->prepare("UPDATE sites SET click = click + 1 WHERE id=:id");
    $id = $_POST["linkId"];
    $query->bindParam(":id", $id);
    $query->execute();
} else  {
    echo "No link passes";
}
?>