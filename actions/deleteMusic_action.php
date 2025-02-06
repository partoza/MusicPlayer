<?php

include "../database/musicplayerDB.php";

try {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (empty($_POST['musicID'])) {
            echo "Music ID is missing.";
            exit;
        }

        $musicID = $_POST['musicID'];

        $stmt = $conn->prepare("SELECT coverimage, audio FROM addMusic WHERE musicID = ?");
        $stmt->bind_param("i", $musicID);
        $stmt->execute();
        $result = $stmt->get_result();
        $musicData = $result->fetch_assoc();
        $stmt->close();

        if (!$musicData) {
            echo "Music not found!";
            exit;
        }

        if (!empty($musicData['coverimage']) && file_exists($musicData['coverimage'])) {
            unlink($musicData['coverimage']);
        }

        if (!empty($musicData['audio']) && file_exists($musicData['audio'])) {
            unlink($musicData['audio']);
        }

        $deleteStmt = $conn->prepare("DELETE FROM addMusic WHERE musicID = ?");
        $deleteStmt->bind_param("i", $musicID);

        if ($deleteStmt->execute()) {
            $deleteStmt->close();
            header("Location: ../features/deleteMusic.php");
            exit;
        } else {
            echo "Error deleting music: " . $deleteStmt->error;
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
