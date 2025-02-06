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
    <link rel="stylesheet" href="../musicplayer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                                <a class="nav-link" href="addMusic.php">Add Music</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link active" href="editMusic.php">Edit Music</a>
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
                <div class="col-12 d-flex justify-content-center justify-content-md-start mt-md-3 mb-md-3"
                    id="listenMusic">
                    <h6 class="fw-semibold fs-1 ps-md-5">Edit Music.</h6>
                </div>
            </div>
            <div class="row">
                <?php
                $query = "SELECT * FROM addMusic ORDER BY favorite DESC, musicID DESC";
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
                                    <h3 class="card-title mb-0" style="color: #1ED760"><?php echo htmlspecialchars($title); ?>
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
                                    <div class="col-12 mt-2">
                                        <button type="button" class="btn text-white" data-bs-toggle="modal"
                                            data-target="#<?php echo $modalID; ?>"
                                            style="width: 100%; background-color: #1ED760; transition: background-color 0.3s;">
                                            <i class="bi bi-pencil-square"></i>&nbsp;Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="<?php echo $modalID; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="modalTitle_<?php echo $musicID; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content bg-dark">
                                    <div class="modal-body">
                                        <div class="row">
                                            <form class="form" action="../actions/editMusic_action.php"
                                                enctype="multipart/form-data" method="POST">

                                                <input type="hidden" name="musicID" value="<?php echo $musicID; ?>">

                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-12 d-flex justify-content-between align-items-center">
                                                        <h3 class="fw-bold" style="color: #1ED760">Edit Music</h3>
                                                        <button type="button" class="btn-close p-2"
                                                            style="background-color: #1ED760; border-radius: 5px; padding: 8px;"
                                                            data-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label>Title</label>
                                                        <input class="form-control" type="text" name="title" required
                                                            value="<?php echo htmlspecialchars($title); ?>" />
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label>Short Description</label>
                                                        <input class="form-control" type="text" name="shortdescription" required
                                                            value="<?php echo htmlspecialchars($shortdescription); ?>" />
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label>Artist</label>
                                                        <input class="form-control" name="artist"
                                                            value="<?php echo htmlspecialchars($artist); ?>" />
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label>Featuring Artist</label>
                                                        <input class="form-control" name="featartist"
                                                            value="<?php echo htmlspecialchars($featartist); ?>" />
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label for="formFile" class="form-label">Import Music Image</label>
                                                        <input class="form-control" type="file" id="formFile"
                                                            accept=".jpg, .jpeg, .png, .webp" name="coverimage"
                                                            value="<?php echo htmlspecialchars($coverImagePath); ?>" />
                                                    </div>
                                                    <div class="col-12 col-sm-6 mt-3">
                                                        <label for="formFile" class="form-label">Import Music Audio</label>
                                                        <input class="form-control" type="file" id="formFile"
                                                            accept=".mp3, .wav, .ogg" name="audio" />
                                                    </div>
                                                    <div class="col-12 mt-3 d-flex align-items-center">
                                                        <input type="checkbox" id="checkbox1" class="checkbox" name="favorite"
                                                            <?php if ($favorite == 1)
                                                                echo 'checked'; ?> />
                                                        <label class="btn-square ms-2" for="btncheck1">Add to Favorites</label>
                                                    </div>
                                                    <div class="col-12 mt-4">
                                                        <button class="btn form-control text-white" type="submit"
                                                            style="width: 100%; background-color: #1ED760; transition: background-color 0.3s;"
                                                            id="buttonEditPlaylist">Edit Playlist</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo '<p class="d-flex justify-content-center align-items-center">No music found in the playlist.</p>';
                }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</body>

</html>