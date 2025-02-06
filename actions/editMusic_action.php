<?php

include "../database/musicplayerDB.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $title = $_POST['title'];
        $shortdescription = $_POST['shortdescription'];
        $artist = $_POST['artist'];
        $featartist = $_POST['featartist'];
        $favorite = isset($_POST['favorite']) ? 1 : 0;
        $musicID = $_POST['musicID']; 

        if (!$musicID) {
            echo "Music ID is missing.";
            exit;
        }

        $stmt = $conn->prepare("SELECT coverimage, audio FROM addMusic WHERE musicid = ?");
        $stmt->bind_param("i", $musicID);
        $stmt->execute();
        $stmt->bind_result($existingCoverImage, $existingAudio);
        $stmt->fetch();
        $stmt->close();

        $coverImagePath = $existingCoverImage;
        $audioPath = $existingAudio;


        $coverImageDir = 'images/';
        $audioDir = 'audio/';

        if (!is_dir($coverImageDir)) {
            mkdir($coverImageDir, 0777, true);
        }

        if (!is_dir($audioDir)) {
            mkdir($audioDir, 0777, true);
        }


        var_dump($_FILES['coverimage']);
        var_dump($_FILES['audio']);


        if (isset($_FILES['coverimage']) && $_FILES['coverimage']['error'] == UPLOAD_ERR_OK) {
            if ($existingCoverImage && file_exists($existingCoverImage)) {
                unlink($existingCoverImage);
            }

            $coverImageTmpName = $_FILES['coverimage']['tmp_name'];
            $coverImageName = $_FILES['coverimage']['name'];
            $coverImagePath = $coverImageDir . basename($coverImageName);

            if (move_uploaded_file($coverImageTmpName, $coverImagePath)) {
                echo "Cover image uploaded successfully";
            } else {
                echo "Error uploading cover image.";
                exit;
            }
        }

        if (isset($_FILES['audio']) && $_FILES['audio']['error'] == UPLOAD_ERR_OK) {
            if ($existingAudio && file_exists($existingAudio)) {
                unlink($existingAudio); 
            }

            $audioTmpName = $_FILES['audio']['tmp_name'];
            $audioName = $_FILES['audio']['name'];
            $audioPath = $audioDir . basename($audioName);

            if (move_uploaded_file($audioTmpName, $audioPath)) {
                echo "Audio uploaded successfully";
            } else {
                echo "Error uploading audio.";
                exit;
            }
        }

        $stmt = $conn->prepare("UPDATE addMusic SET title = ?, shortdescription = ?, artist = ?, featartist = ?, coverimage = ?, audio = ?, favorite = ? WHERE musicid = ?");
        $stmt->bind_param("ssssssii", $title, $shortdescription, $artist, $featartist, $coverImagePath, $audioPath, $favorite, $musicID);

        if ($stmt->execute()) {
            echo "Record updated successfully!";
            header("Location: ../features/listenMusic.php");
            exit;
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}