<?php
require_once("../config.php");

if(isset($_POST["imageUrl"])){
    $query = $con->prepare("UPDATE images SET clicks = clicks + 1 WHERE imageUrl=:imageUrl");
    $imageUrl = $_POST["imageUrl"];
    $query->bindParam(":imageUrl", $imageUrl);
    $query->execute();
} else  {
    echo "No link passes";
}
?>