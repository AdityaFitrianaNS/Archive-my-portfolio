<?php

require '../../app/controllers/anime_user.php';

$keyword = $_GET['keyword'];
$query = "SELECT * FROM anime_user WHERE
        judul LIKE '%$keyword' OR
        musim LIKE '%$keyword' OR
        posted_by LIKE '%$keyword'
        ";
$anime_user = query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="shortcun icon" href="../img/icon_shimarin.png">
    <title>Ajax Anime</title>
</head>
<body>
    <!-- Card -->
    <div class="row" id="card_container">
        <?php foreach ($anime_user as $card) :
            $tanggal_posting = $card['date_posted'];
            $date = new DateTime($tanggal_posting); ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card" style="height: 26.5rem;">
                    <img src="../../public/img/upload_anime/<?= $card['gambar']; ?>" class="img-fluid" alt="waifu" style="object-fit: cover; height: 225px;">
                    <div class="card-body py-2">
                        <h4 class="card-title mb-2">
                            <?= $card['judul']; ?>
                        </h4>
                        <p class="card-text mb-0">
                            <i class="bi bi-brightness-alt-high"></i>
                            <?= $card['musim']; ?>
                        </p>
                        <p class="card-text mb-0">
                            <i class="bi bi-camera-video"></i>
                            <?= $card['studio']; ?>
                        </p>
                        <p class="card-text mb-0">
                            <i class="bi bi-cloud-arrow-up"></i>
                            Posted by <?= $card['posted_by']; ?>
                        </p>
                        <p class="card-text mb-1">
                            <i class="bi bi-calendar3-event"></i>
                            <?= $date->format('d-m-Y'); ?>
                        </p>
                        <span class="text-muted float-start mt-2">
                            <i class="bi bi-clock"></i>
                            Last update <?= $date->format('H:i:s'); ?>
                        </span>
                        <a class="btn btn-md btn-primary btn-outline-info float-end" id="sinopsis_anime" data-bs-toggle="modal"
                            data-bs-target="#sinopsis_modal" style="color: white;" 
                            data-id="<?= $card['id_anime']; ?>"
                            data-judul="<?= $card['judul']; ?>"
                            data-sinopsis="<?= $card['sinopsis']; ?>">
                        <i class="bi bi-info-circle"></i> Sinopsis
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>