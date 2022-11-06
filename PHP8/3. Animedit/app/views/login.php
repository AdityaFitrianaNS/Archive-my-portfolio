<?php
session_start();

require '../controllers/user.php';

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['foto'] = $user['foto'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION["login"] = true;
            echo "
            <script>
                alert('Berhasil login!');
                document.location.href = 'waifu';
            </script>
            ";
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- script JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- CDN Sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="shortcun icon" href="../../public/img/icon_shimarin.png">
    <title>Login Animedit</title>
</head>
<body>
    <section>
        <div class="imgBx bg-primary">
            <img src="../../public/img/shimarin.png" alt="backgroundForm" class="" >
        </div>
        <div class="contentBx">
            <div class="formBx">
                <h2 class="mt-4">Login</h2>
                <?php if (isset($error)) : ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Username atau Password salah!'
                        });
                    </script>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="inputBx">
                        <label for="username" class="label">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="inputBx">
                        <label for="password" class="label">Password</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="remember">
                        <label><input type="checkbox" name="">Remember me</label>
                    </div>
                    <div class="inputBx">
                        <input type="submit" class="tombol" name="login" id="login" value="Login">
                    </div>
                    <div class="inputBx">
                        <p>Tidak memiliki akun? <a href="registrasi.php" data-bs-toggle="modal" data-bs-target="#registrasi_modal"> Registrasi</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Modal registrasi -->
    <div class="modal fade" id="registrasi_modal" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #03a9f4;">
                    <h5 class="modal-title text-light">Registrasi Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
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
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                        <div class="mb-2">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password2" class="form-label">Konfirm Password</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukkan ulang password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="regist" class="btn btn-primary float-end ms-1 btn-outline-info text-white">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        <?php
        if (isset($_POST["regist"])) {
            if (registrasi($_POST) > 0) {
        ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Registrasi berhasil, silahkan lakukan login!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = 'login';
                    }
                });
        <?php
            } else {
                echo  "
                <script>
                    alert('Data Gagal ditambahkan!');
                    document.location.href = 'login';
                </script>
                ";
                }
            }
        ?>
    </script>
</body>
</html>