<?php
include "../database/musicplayerDB.php";

if (isset($_GET['musicID'])) {
    $musicID = $_GET['musicID'];

    $stmt = $conn->prepare("SELECT audio FROM addMusic WHERE musicID = ?");
    $stmt->bind_param("i", $musicID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($audioData);
    $stmt->fetch();

    if ($audioData) {
        header("Content-Type: audio/mpeg");
        echo $audioData;
    } else {
        echo "Audio not found!";
    }
}
?>
