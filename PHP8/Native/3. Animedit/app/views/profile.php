<?php
session_start();

// Jika tidak ada login, kembalikan kehalaman login
if (!isset($_SESSION["login"])) {
    header("Location: login");
    exit;
}

require '../controllers/user.php';
$user = query("SELECT foto FROM user WHERE id_user = '$_SESSION[id_user]'");

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
    <title>All Anime User</title>
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
                        <a class="nav-link mx-1" href="anime">Anime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="all_waifu">All Waifu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1" href="all_anime">All Anime</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-1 active text-light" href="profile">Profile</a>
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
    <!-- Profile User -->
    <div class="container rounded bg-white py-5 mb-5">
        <div class="row">
        <h3 class="text-center mt-4 py-3">Profile <?= $_SESSION['username']; ?></h3>
            <div class="col-md-12 mt-2 border-right">
                <div class="d-flex flex-column align-items-center text-center">
                    <?php foreach ($user as $img) : ?>
                        <img class="rounded-circle mb-2" height="" src="../../public/img/upload_user/<?= $img['foto'];?>"style="object-fit: cover; height: 160px; width:160px;">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-12 border-right">
                <div class="p-3 py-4">
                    <div class="row offset-lg-3 offset-md-1">
                        <div class="col-md-4">
                            <label class="labels mb-1">First name</label>
                            <input type="text" class="form-control mb-2" value="<?= $_SESSION['first_name']; ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="labels mb-1">Last name</label>
                            <input type="text" class="form-control mb-2" value="<?= $_SESSION['last_name']; ?>" disabled>
                        </div>
                    </div>
                    <div class="row offset-lg-3 offset-md-1">
                        <div class="col-md-4">
                            <label class="labels mb-1">Username</label>
                            <input type="text" class="form-control mb-2" value="<?= $_SESSION['username']; ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="labels mb-1">Email</label>
                            <input type="text" class="form-control mb-2" value="<?= $_SESSION['email']; ?>" disabled>
                        </div>
                        <div class="mt-2">
                            <a href="home" class="btn btn-primary" style="width: 123px;"><i class="bi bi-arrow-left"></i> Back</a>
                            <a type="s" class="btn btn-primary" style="width: 123px;" id="change_profile" data-bs-toggle="modal" data-bs-target="#change_modal"
                                data-id="<?= $_SESSION['id_user']; ?>"
                                data-foto="<?= $_SESSION['foto']; ?>"
                                data-first="<?= $_SESSION['first_name']; ?>" 
                                data-last="<?= $_SESSION['last_name']; ?>"
                                data-email="<?= $_SESSION['email']; ?> ">
                                <i class="bi bi-pencil-square"></i>
                                Change
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal ubah profile-->
        <div class="modal fade" id="change_modal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white text-center">Ubah Waifu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" id="id_user">
                            <input type="hidden" name="foto_lama" value="<?= $_SESSION["foto"]; ?>">
                            <div class="mb-2">
                                <label for="foto_lama" class="form-label">Foto</label>
                                <input type="file" class="form-control" name="foto" id="foto" placeholder="Upload foto waifu" required>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" required>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Upload email waifu" required>
                            </div>
                            <div class="float-end">
                                <button type="button" class="btn btn-md btn-secondary m-1" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="change" class="btn btn-md btn-info text-light">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Jika button change ditekan
        $(document).on("click", "#change_profile", function() {
            // maka variabel untuk menangkap data target yang ada didalam tag <a> misal data-id
            let id = $(this).data('id');
            let foto = $(this).data('foto');
            let first = $(this).data('first');
            let last = $(this).data('last');
            let email = $(this).data('email');

            // Mengambil id yang ada pada setiap tag input didalam class modal-body
            $(".modal-body #id_user").val(id);
            $(".modal-body #foto_lama").val(foto);
            $(".modal-body #first_name").val(first);
            $(".modal-body #last_name").val(last);
            $(".modal-body #email").val(email);
        });

        <?php
        // Jika button change ditekan
        if (isset($_POST["change"])) {
            // maka, jika update anime lebih dari 0 (berhasil) maka menampilkan alert berhasil
            if (updateUser($_POST) > 0) {
            ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data profilemu berhasil diubah ^-^',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'profile';
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
                    text: 'Silahkan isi form dengan benar!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'profile';
                    }
                })
                </script>
                ";
                exit;
                }
            }
        ?>  
    </script>
</body>
</html>