<?php

try {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "musicplayer";

    $conn = new mysqli($host, $username, $password);

    if ($conn->connect_error) {
        die("Database connection unsuccesfull: " . $conn->connect_error);
    }

    $createDBQuery = "CREATE DATABASE IF NOT EXISTS $database";

    if (!$conn->query($createDBQuery)) {
        die("Error Creating Database" . $conn->error);
    }

    $conn->select_db($database);

    $createTableQuery = "CREATE TABLE IF NOT EXISTS addMusic (
        musicID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        shortdescription VARCHAR(100) NOT NULL,
        artist VARCHAR(100) NOT NULL,
        featartist VARCHAR(100),
        coverimage LONGBLOB NOT NULL,  
        audio LONGBLOB NOT NULL,      
        favorite BOOLEAN NOT NULL
    )";

    if (!$conn->query($createTableQuery)) {
        die("Error Creating Database" . $conn->error);
    }

    // echo "Database created Successfully";

} catch (\Exception $e) {
    echo "Error: " . $e;
}

?>