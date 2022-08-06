<?php
session_start();

// Jika tidak ada login, kembalikan kehalaman login
if (!isset($_SESSION["login"])) {
    header("Location: login");
    exit;
}

require '../controllers/anime_user.php';

// Konfigurasi untuk Pagination
$dataPerHalaman = 6;
$jumlahData = count(query("SELECT * FROM anime_user"));
$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;

// variabel query
$anime_user = query("SELECT * FROM anime_user WHERE id_user = '$_SESSION[id_user]' LIMIT $awalData, $dataPerHalaman");

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
    <title>Anime <?= $_SESSION['username']; ?></title>
</head>
<body>
    <!-- Navbar -->
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
                        <a class="nav-link mx-1 active text-light" href="anime">Anime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="all_waifu">All Waifu</a>
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
    <!-- Content -->
    <br><br>
    <div class="container-md mt-4 py-3">
        <h3 style="text-align: center;">Anime Animedit</h3>
        <br>
        <div class="mt-4 offset-sm-0 col-sm-3 py-1 mb-1">
            <div class="py-2">
                <button type="button" class="btn btn-md btn-primary btn-outline-info" data-bs-toggle="modal" data-bs-target="#posting_modal" style="color: white;">
                    <i class="bi bi-plus-circle"></i>
                    Posting Anime
                </button>
            </div>
        </div>
        <!-- Container -->
        <div class="row" id="card_container">
            <?php foreach ($anime_user as $card) :
                $anime = query("SELECT gambar FROM anime_user")[0];
                $tanggal_posting = $card['date_posted'];
                $date = new DateTime($tanggal_posting); ?>
                <!-- Card -->
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card" style="height: 26.5rem;">
                        <a href="hapus_anime.php?id_anime=<?= $card["id_anime"]; ?>" id="btn-hapus">
                            <button type="button" class="btn btn-md btn-primary btn-outline-info position-absolute" style="left:7px; top: 7px;">
                                <i class="bi bi-lg bi-trash" style="color: white; font-style:normal"></i>
                            </button>
                        </a>
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
                            <p class="card-text mb-2 text-muted">
                                <i class="bi bi-clock"></i>
                                Last post <?= $date->format('d-m-Y'); ?>
                            </p>
                            <a class="btn btn-md btn-primary btn-outline-info" id="sinopsis_anime" data-bs-toggle="modal" 
                                data-bs-target="#sinopsis_modal" style="color: white;"
                                data-id="<?= $card['id_anime']; ?>"
                                data-judul="<?= $card['judul'];?>"
                                data-sinopsis ="<?= $card['sinopsis'];?>">
                                <i class="bi bi-info-circle"></i> Sinopsis
                            </a>
                            <!-- Jika ingin ubah menggunakan modal, maka pada tag <a> mengambil semua data untuk mengisi value update pada modal -->
                            <a class="btn btn-md btn-primary btn-outline-info" id="ubah_anime" data-bs-toggle="modal"
                                data-bs-target="#ubah_modal" style="color: white;"
                                data-id="<?= $card['id_anime']; ?>"
                                data-gambar="<?= $card['gambar']; ?>"
                                data-judul="<?= $card['judul'];?>" 
                                data-studio="<?= $card['studio']; ?>"
                                data-sinopsis ="<?= $card['sinopsis'];?>">
                                <i class="bi bi-pencil-square"></i>
                                Ubah Anime
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Modal Posting Waifu -->
        <div class="modal fade" id="posting_modal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-light">Posting Anime</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-2">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar">
                            </div>
                            <div class="mb-2">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul anime" required>
                            </div>
                            <div class="mb-2">
                                <label for="musim" class="form-label">Musim</label>
                                <select class="form-select" name="musim">
                                    <option selected>Pilih Musim</option>
                                    <option value="Male">Spring</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Fall">Fall</option>
                                    <option value="Winter">Winter</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="studio" class="form-label">Studio</label>
                                <input type="text" class="form-control" name="studio" id="studio" placeholder="Masukkan studio anime" required>
                            </div>
                            <input type="hidden" class="form-control" name="posted_by" id="posted_by" value="<?= $_SESSION['username']; ?>">
                            <div class="mb-3">
                                <label for="sinopsis" class="form-label">Sinopsis</label>
                                <textarea type="text" class="form-control" name="sinopsis" id="sinopsis" placeholder="Masukkan sinopsis anime" required> </textarea>
                            </div>
                            <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $_SESSION['id_user']; ?>">
                            <div class="float-end">
                                <button type="button" class="btn btn-md btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="posting" class="btn btn-md btn-info text-light">Posting</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sinopsis modal -->
        <div class="modal fade" id="sinopsis_modal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title float-end text-light">
                            <i class="bi bi-info-circle" style="color: white;"></i> 
                            Sinopsis Anime
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <textarea name="sinopsis" class="form-control bg-info text-light"
                            id="sinopsis_anime" cols="50" rows="6" disabled></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ubah modal anime-->
        <div class="modal fade" id="ubah_modal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white text-center">Ubah Anime</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_anime" id="id_anime">
                            <input type="hidden" name="gambar_lama" value="<?= $anime["gambar"]; ?>">
                            <div class="mb-2">
                                <label for="gambar_lama" class="form-label">Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar" placeholder="Upload gambar waifu" required>
                            </div>
                            <div class="mb-2">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul anime" required>
                            </div>
                            <div class="mb-2">
                                <label for="studio" class="form-label">Studio</label>
                                <input type="text" class="form-control" name="studio" id="studio" placeholder="Masukkan studio dari" required>
                            </div>
                            <div class="mb-3">
                                <label for="sinopsis" class="form-label">Sinopsis</label>
                                <textarea type="text" class="form-control" name="sinopsis" id="sinopsis" rows="4" placeholder="Masukkan sinopsis anime" required> </textarea>
                            </div>
                            <div class="float-end">
                                <button type="button" class="btn btn-md btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="ubah" class="btn btn-md btn-info text-light">Ubah</button>
                            </div>
                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php
        // Jika button posting ditekan
        if (isset($_POST["posting"])) {
            // Cek apakah data berhasil ditambahkan atau tidak
            if (postAnime($_POST) > 0) {
        ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Animemu berhasil diposting!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'anime';
                    }
                })
        <?php
            // jika gagal post anime, maka menampilkan alert gagal
            } else {
                echo "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Silahkan isi form dengan benar!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'anime';
                    }
                })
                </script>
                ";
                exit;
                }
            }
        ?>

        // Jika button ubah ditekan
        $(document).on("click", "#ubah_anime", function() {
            // maka variabel untuk menangkap data target yang ada didalam tag <a> misal data-id
            let id = $(this).data('id');
            let gambar = $(this).data('gambar');
            let judul = $(this).data('judul');
            let studio = $(this).data('studio');
            let sinopsis = $(this).data('sinopsis');

            // Mengambil id yang ada pada setiap tag input didalam class modal-body
            $(".modal-body #id_anime").val(id);
            $(".modal-body #gambar_lama").val(gambar);
            $(".modal-body #judul").val(judul);
            $(".modal-body #studio").val(studio);
            $(".modal-body #sinopsis").val(sinopsis);
        });

        <?php
        // Jika button ubah ditekan
        if (isset($_POST["ubah"])) {
            // maka, jika update anime lebih dari 0 (berhasil) maka menampilkan alert berhasil
            if (updateAnime($_POST) > 0) {
            ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data animemu berhasil diubah ^-^',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'anime';
                    }
                })
            <?php
            // Jika gagal update anime, maka menampilkan alert gagal
            } else {
                echo "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Judul animemu sudah diupload oleh user lain!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'anime';
                    }
                })
                </script>
                ";
                exit;
                }
            }
        ?>
        
        // Jika button sinopsis ditekan
        $(document).on("click", "#sinopsis_anime", function() {
            // Maka membuat variabel untuk menangkap data target yang ada didalam tag <a> misal data-judul
            let judul = $(this).data('judul');
            let sinopsis = $(this).data('sinopsis');
            
            $(".modal-body #sinopsis_anime").val(sinopsis);
        });

        // Hapus waifu
        $(document).on('click', '#btn-hapus', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                icon: 'warning',
                title: 'Apakah kamu yakin?',
                text: "Animemu akan dihapus!",
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Animemu berhasil dihapus!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = link;
                        }
                    })
                }
            })
        })
    </script>
</body>
</html>