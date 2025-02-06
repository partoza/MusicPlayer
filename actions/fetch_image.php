<?php
include "../database/musicplayerDB.php";

if (isset($_GET['musicID'])) {
    $musicID = $_GET['musicID'];

    $stmt = $conn->prepare("SELECT coverimage FROM addMusic WHERE musicID = ?");
    $stmt->bind_param("i", $musicID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($coverImageData);
    $stmt->fetch();

    if ($coverImageData) {
        header("Content-Type: image/jpeg"); 
        echo $coverImageData;
    } else {
        echo "Image not found!";
    }
}
?>
