<?php include "../database/musicplayerDB.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../musicplayer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                    <div class="fw-medium" id="navbarNav">
                        <ul class="text-white navbar-nav navigation_list">
                            <li class="nav-item mx-5">
                                <a class="nav-link active" href="listenMusic.php">Listen Music</a>
                            </li>
                            <li class="nav-item mx-5">
                                <a class="nav-link" href="addMusic.php">Add Music</a>
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
        <div class="container ps-md-2">
            <div class="row ps-md-2">
                <div class="col-12 d-flex justify-content-center justify-content-md-start mt-md-3 mb-md-3"
                    id="listenMusic">
                    <h6 class="fw-semibold fs-1 ps-md-5">My Music.</h6>
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
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h3 class="card-title mb-0" style="color: #1ED760">
                                            <?php echo htmlspecialchars($title); ?>
                                        </h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                            class="bi bi-play-circle-fill" viewBox="0 0 16 16" style="color: #1ED760;">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814z" />
                                        </svg>
                                    </div>
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
                                    <?php } ?>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="<?php echo $modalID; ?>" tabindex="-1"
                            aria-labelledby="modalTitle_<?php echo $musicID; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-dark">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 d-flex mb-3 justify-content-between align-items-center">
                                                <h3 class="modal-title">Listening ...</h3>
                                                <button type="button" class="btn-close p-2"
                                                    style="background-color: #1ED760; border-radius: 5px; padding: 8px;"
                                                    data-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="col-4">
                                            <img src="../actions/<?php echo htmlspecialchars($coverImagePath); ?>" class="card-img-top"
                                            alt="Cover Image" style="width: 100%; height: autopx">
                                            </div>
                                            <div class="col-8">
                                                <div class="col-12 d-flex justify-content-between align-items-center">
                                                    <h2 class="card-title" style="color: #1ED760">
                                                        <?php echo htmlspecialchars($title); ?>
                                                    </h2>
                                                    <?php if ($favorite) { ?>
                                                        <span class="badge" style="background-color: #1ED760">Favorite</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-12">
                                                    <span class="card-text"><strong>Artist:</strong>
                                                        <?php echo htmlspecialchars($artist); ?></span>
                                                </div>
                                                <div class="col-12">
                                                    <?php if (!empty($featartist)) { ?>
                                                        <span class="card-text"><strong>Featuring:</strong>
                                                            <?php echo htmlspecialchars($featartist); ?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-12">
                                                    <p class="card-text mt-3" style="font-family: Helvetica, sans-serif;">
                                                        "<?php echo htmlspecialchars($shortdescription); ?>"
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <audio controls class="mt-3 d-mt-block" id="<?php echo $audioID; ?>"
                                                    style="width: 100%;">
                                                    <source src="../actions/<?php echo htmlspecialchars($audioPath); ?>"
                                                    type="audio/mp3">
                                                        type="audio/mp3">
                                                </audio>
                                            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modals = document.querySelectorAll('.modal');
            var allAudios = document.querySelectorAll('audio');

            allAudios.forEach(function (audio) {
                audio.addEventListener('play', function () {
                    allAudios.forEach(function (otherAudio) {
                        if (otherAudio !== audio) {
                            otherAudio.pause();
                            otherAudio.currentTime = 0;
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>