<?php
include '../database/musicplayerDB.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../musicplayer.css">
    <style>
        .btn:hover {
            background-color: #128c44 !important;
            color: rgb(29, 29, 29) !important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold fs-1" style="color: #1ED760;">MUSIC PLAYER.</h1>
                <h6 class="fw-semibold">Developed By: John Rex Partoza</h6>
            </div>
            <hr style="border: 1px solid #1ED760; width: 90%; margin: 10px auto;">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <nav class="navbar navbar-expand-lg">
                    <div class=" fw-medium" id="navbarNav">
                        <ul class="text-white navbar-nav navigation_list">
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="listenMusic.php">Listen Music</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link active" href="addMusic.php">Add Music</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="editMusic.php">Edit Music</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="deleteMusic.php">Delete Music</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <hr style="border: 1px solid #1ED760; width: 90%; margin: 10px auto;">
        </div>
        <div class="contanier ps-md-2">
            <div class="row ps-md-2">
                <div class="col-12 d-flex justify-content-center justify-content-md-start mt-2 mt-md-3 mb-md-3"
                    id="list2
                    .087.enMusic">
                    <h6 class="fw-semibold fs-1 ps-md-5">Add Music.</h6>
                </div>
                <div class="row ms-1">
                    <form class="form" action="../actions/addMusic_action.php" enctype="multipart/form-data"
                        method="POST">
                        <div class="row d-flex justify-content-between">

                            <div class="col-12 col-sm-6 mt-3">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" required
                                    style="box-shadow: #1ED760;" />
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label>Short Description</label>
                                <input class="form-control" type="text" name="shortdescription" required
                                    style="box-shadow: #1ED760;" />
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label>Artist</label>
                                <input class="form-control" name="artist" required></input>
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label>Featuring Artist</label>
                                <input class="form-control" name="featartist"></input>
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label for="formFile" class="form-label">Import Music Image</label>
                                <input class="form-control" type="file" id="formFile" accept=".jpg, .jpeg, .png, .webp"
                                    name="coverimage" required>
                            </div>

                            <div class="col-12 col-sm-6 mt-3">
                                <label for="formFile" class="form-label">Import Music Audio</label>
                                <input class="form-control" type="file" id="formFile" accept=".mp3, .wav, .ogg"
                                    name="audio" required>
                            </div>

                            <div class="col-12 mt-3 d-flex align-items-center">
                                <input type="checkbox" id="checkbox1" class="checkbox" value="1" name="favorite">
                                <label class="btn-square ms-2" for="btncheck1">Add to Favorites</label>
                            </div>

                            <div class="col-12 mt-4">
                                <button class="btn form-control text-white" type="submit"
                                    style="width: 100%; background-color: #1ED760; transition: background-color 0.3s;"
                                    id="buttonAddPlaylist"><i class="bi bi-plus-lg"></i>&nbsp;Add
                                    Playlist</button>
                            </div>
                        </div>
                    </form>
                    <div class="col-12 d-flex justify-content-center justify-content-md-start mt-md-5" id="listenMusic">
                        <h6 class="fw-semibold fs-1 mt-5 mt-md-2 ps-md-2">Latest Add Music</h6>
                    </div>
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM addMusic ORDER BY musicID DESC LIMIT 4";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $title = $row['title'];
                                $shortdescription = $row['shortdescription'];
                                $artist = $row['artist'];
                                $featartist = $row['featartist'];
                                $coverImagePath = $row['coverimage'];
                                $audioPath = $row['audio'];
                                $favorite = $row['favorite'];
                                $musicID = $row['musicID'];


                                $modalID = "musicModal_" . $musicID;
                                $audioID = "audio_" . $musicID;
                                ?>
                                <div class="col-12 col-sm-6 col-md-3 mt-3 d-flex justify-content-center">
                                    <div class="card bg-dark text-white" style="width: 18rem;" type="button" data-toggle="modal"
                                        data-target="#<?php echo $modalID; ?>">
                                        <img src="../actions/<?php echo htmlspecialchars($coverImagePath); ?>" class="card-img-top"
                                        alt="Cover Image" style="width: 100%; height: 230px">
                                        <div class="card-body">
                                            <h3 class="card-title mb-0" style="color: #1ED760">
                                                <?php echo htmlspecialchars($title); ?>
                                            </h3>
                                            <span class="card-text"><strong>Artist:</strong>
                                                <?php echo htmlspecialchars($artist); ?></span>
                                            <br>
                                            <?php if (!empty($featartist)) { ?>
                                                <span class="card-text"><strong>Featuring:</strong>
                                                    <?php echo htmlspecialchars($featartist); ?></span>

                                            <?php } ?>
                                            <br>
                                            <?php if ($favorite) { ?>
                                                <span class="badge mt-2" style="background-color: #1ED760">Favorite</span>
                                            <?php } else { ?>
                                                <br>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        } else {
                            echo '<p class="d-flex justify-content-center align-items-center">No music add in the playlist.</p>';
                        }
                        ?>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>