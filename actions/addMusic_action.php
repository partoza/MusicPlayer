<?php

include "../database/musicplayerDB.php";

try {

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $title = $_POST['title'];
        $shortdescription = $_POST['shortdescription'];
        $artist = $_POST['artist'];
        $featartist = $_POST['featartist'];
        $favorite = isset($_POST['favorite']) ? 1 : 0;

        $coverImagePath = 'images/';

        if (!is_dir($coverImagePath)) {
            mkdir($coverImagePath, 0777, true); 
        }

        if (isset($_FILES['coverimage']) && $_FILES['coverimage']['error'] == UPLOAD_ERR_OK) {
            $coverImageTmpName = $_FILES['coverimage']['tmp_name'];
            $coverImageName = $_FILES['coverimage']['name'];
            $coverImagePath .= basename($coverImageName);  

            if (move_uploaded_file($coverImageTmpName, $coverImagePath)) {
                echo "Cover image uploaded successfully!";
            } else {
                echo "Error uploading cover image.";
                exit;
            }
        } else {
            echo "No cover image uploaded or error in uploading.";
            exit;
        }

        $audioPath = 'audio/'; 
        if (!is_dir($audioPath)) {
            mkdir($audioPath, 0777, true); 
        }

        if (isset($_FILES['audio']) && $_FILES['audio']['error'] == UPLOAD_ERR_OK) {
            $audioTmpName = $_FILES['audio']['tmp_name'];
            $audioName = $_FILES['audio']['name'];
            $audioPath .= basename($audioName);  // Full path for saving the audio

            // Move the uploaded file to the target directory
            if (move_uploaded_file($audioTmpName, $audioPath)) {
                echo "Audio uploaded successfully!";
            } else {
                echo "Error uploading audio.";
                exit;
            }
        } else {
            echo "No audio file uploaded or error in uploading.";
            exit;
        }


        $stmt = $conn->prepare("INSERT INTO addMusic (title, shortdescription, artist, featartist, coverimage, audio, favorite) VALUES (?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssi", $title, $shortdescription, $artist, $featartist, $coverImagePath, $audioPath, $favorite);

        if ($stmt->execute()) {
            header("Location: ../features/listenMusic.php");
            exit;
        } else {
            echo "Operation Failed: " . $stmt->error;
        }
    }

} catch (\Exception $e) {
    echo "Error: " . $e;
}

?>