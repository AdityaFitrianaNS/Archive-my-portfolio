<?php

require '../../app/controllers/waifu_user.php';

$keyword = $_GET['keyword'];
$query = "SELECT * FROM waifu_user WHERE
        nama LIKE '%$keyword' OR
        anime LIKE '%$keyword' OR
        gender LIKE '%$keyword' 
        ";
$waifu_user = query($query);

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
    <title>Tabel Guru</title>
</head>
<body>
    <!-- Card -->
    <div class="row" id="card_container">
        <?php foreach ($waifu_user as $card) :
            $tanggal_posting = $card['date_posted'];
            $date = new DateTime($tanggal_posting); ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card" style="height: 26.5rem;">
                    <img src="../../public/img/upload_waifu/<?= $card['gambar']; ?>" class="img-fluid" alt="waifu" style="object-fit: cover; height: 225px;">
                    <div class="card-body py-2">
                        <h4 class="card-title mb-2">
                            <?= $card['nama']; ?>
                        </h4>
                        <p class="card-text mb-0">
                            <i class="bi bi-search-heart"></i>
                            <?= $card['anime']; ?>
                        </p>
                        <p class="card-text mb-0">
                            <i class="bi bi-person-square"></i>
                            <?= $card['gender']; ?>
                        </p>
                        <p class="card-text mb-0">
                            <i class="bi bi-cloud-arrow-up"></i>
                            Posted by <?= $card['posted_by']; ?>
                        </p>
                        <p class="card-text mb-2 text-muted">
                            <i class="bi bi-clock"></i>
                            Last post <?= $date->format('d-m-Y'); ?>
                        </p>
                        <a class="btn btn-md btn-primary btn-outline-info" id="detail_waifu" data-bs-toggle="modal" data-bs-target="#deskripsi_modal" style="color: white;" data-id="<?= $card['id_waifu']; ?>" data-nama="<?= $card['nama']; ?>" data-deskripsi="<?= $card['deskripsi']; ?>">
                            <i class="bi bi-door-open"></i> Deskripsi
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>