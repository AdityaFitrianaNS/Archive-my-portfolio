<?php
session_start();

// Jika tidak ada login, kembalikan kehalaman login
if (!isset($_SESSION["login"])) {
    header("Location: login");
    exit;
}

require '../controllers/waifu_user.php';

// Konfigurasi untuk Pagination
$dataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM waifu_user"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

// variabel query
$waifu_user = query("SELECT * FROM waifu_user ORDER BY id_waifu LIMIT $awalData, $dataPerHalaman");

// Tombol search ditekan
if (isset($_POST["cari"])) {
    $waifu_user = searchWaifu($_POST['keyword']);
}

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
    <link rel="stylesheet" href="../../public/css/bs.css">
    <link rel="shortcun icon" href="../../public/img/icon_shimarin.png">
    <title>All Waifu User</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light position-absolute top-0 start-0 end-0 bg-info p-1">
        <div class="container-fluid">
            <a href="waifu" class="navbar-brand mx-5 ms-2" href="#" style="font-size: 17px;">
                Animedit 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="waifu">Waifu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="anime">Anime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 active text-light" href="all_waifu">All Waifu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="all_anime">All Anime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="profile">Profile</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-0" style="font-size: 12;">
                            Hai,<?= $_SESSION['username']; ?>
                        </a>
                    </li>
                    <li class="nav-item mx-0">
                        <a href="logout.php">
                            <button type="button" class="btn btn-sm btn-primary mt-1">
                                <i class="bi bi-box-arrow-in-right"></i> Logout
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br><br>
    <!-- Content -->
    <div class="container-md mt-4 py-3">
        <h3 style="text-align: center;">All Waifu User</h3>
        <br>
        <div class="mt-4 offset-sm-0 col-sm-3 py-1 mb-1">
            <div class="py-2">
                <form action="" method="POST" class="d-flex">
                    <input class="form-control me-2" type="text" name="keyword" id="keyword" placeholder="Masukkan pencarian" autocomplete="off">
                    <button class="btn btn-outline-primary" type="submit" name="cari" id="tombol-cari">
                        Search
                    </button>
                </form>
            </div>
        </div>
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
                            <p class="card-text mb-1">
                                <i class="bi bi-calendar3-event"></i>
                                <?= $date->format('d-m-Y'); ?>
                            </p>
                            <span class="text-muted float-start mt-2">
                                <i class="bi bi-clock"></i>
                                Last update <?= $date->format('H:i:s'); ?>
                            </span>
                            <a class="btn btn-md btn-primary btn-outline-info float-end" id="detail_waifu" data-bs-toggle="modal" data-bs-target="#deskripsi_modal" style="color: white;" data-id="<?= $card['id_waifu']; ?>" data-nama="<?= $card['nama']; ?>" data-deskripsi="<?= $card['deskripsi']; ?>">
                                <i class="bi bi-info-circle"></i> Deskripsi
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Deskripsi modal -->
        <div class="modal fade" id="deskripsi_modal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title float-end text-light"><i class="bi bi-info-circle" style="color: white;"></i> Deskripsi Waifu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <textarea name="deskripsi" class="form-control bg-info text-light" id="deskripsi_waifu" cols="50" rows="5" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navigasi Pagination -->
        <nav>
            <ul class="pagination justify-content-start mt-1">
                <?php if ($halamanAktif > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>">Kembali</a>
                    </li>
                <?php endif; ?>
                <!--  -->
                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif) : ?>
                        <!-- Halaman yang sama tidak perlu di isi hrefnya -->
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $i; ?>" style="font-weight: bold; color: blue;"><?= $i; ?></a>
                        </li>
                    <?php else : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>">Berikutnya</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <script src="../../public/js/live_search_waifu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).on("click", "#detail_waifu", function() {
            let nama = $(this).data('nama');
            let deskripsi = $(this).data('deskripsi');

            $(".modal-body #nama_waifu").val(nama);
            $(".modal-body #deskripsi_waifu").val(deskripsi);
        });
    </script>
</body>
</html>