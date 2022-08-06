<?php

// Koneksi ke database dengan global variabel $conn
$conn = mysqli_connect("localhost","root","","db_animedit");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($regist) {
    global $conn;

    $first_name = htmlspecialchars(stripslashes($regist['first_name']));
    $last_name = htmlspecialchars(stripslashes($regist['last_name']));
    $email = htmlspecialchars(stripslashes($regist['email']));
    $username = htmlspecialchars(stripslashes($regist['username']));
    $password = mysqli_real_escape_string($conn, $regist['password']);
    $password2 = mysqli_real_escape_string($conn, $regist['password2']);

    // Konfirm password
    if ($password !== $password2) {
        echo "<script>
        alert('Password dengan Konfirmasi Password tidak sesuai!');
        </script>";

        // Kembalikan nilai false(gagal)
        return false; 
    }
    // Username tidak boleh duplikat
    $validasiUsername = mysqli_query($conn, "SELECT username from user WHERE username = '$username'");
    
    if(mysqli_fetch_assoc($validasiUsername)) {
        // Kembalikan nilai false(gagal)
        return false;
    }

    // Upload foto
    $foto = upload();
    if (!$foto) {
        return false;
    }

    // Encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES(
        '','$foto','$first_name','$last_name','$email','$username','$password',now())");

    return mysqli_affected_rows($conn);

}

function upload() {
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
    

    // Cek foto di upload atau tidak
    if($error === 4) {
        echo "<script>
        alert('Gagal, foto tidak di upload');
        </script>";
        return false;
    }

    // Cek format yang diupload adalah foto
    $formatFotoValid = ['jpg','jpeg','png'];
    $formatFoto = explode('.', $namaFile);
    $formatFoto = strtolower(end($formatFoto));
    if(!in_array($formatFoto, $formatFotoValid)) {
        echo "<script>
        alert('Pilih format foto jpg/jpeg/png');
        </script>";
        return false;
    }

    // Cek ukuran foto terlalu besar
    $formatFile = [ ' > 1500000 ' ];
    if(in_array($ukuranFile, $formatFile)) {
        echo "<script>
        alert('Ukuran file terlalu besar!');
        </script>";     
        return false;
    }
    
    // Lolos pengecekan file, maka akan generate nama pada file.
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $formatFoto;
    move_uploaded_file($tmpName, '../../public/img/upload_user/' . $namaFileBaru);
    return $namaFileBaru;
    
}

function updateUser($updateUser) {
    global $conn;
    $id_user = $updateUser['id_user'];
    $first_name = htmlspecialchars(stripslashes($updateUser['first_name']));
    $last_name = htmlspecialchars(stripslashes($updateUser['last_name']));
    $email = htmlspecialchars(stripslashes($updateUser['email']));
    $foto_lama = htmlspecialchars(stripslashes($updateUser['foto_lama']));

    if ($_FILES['foto']['error'] === 4 ) {
        $foto = $foto_lama;
    } else {
        $foto = upload();
    }

    $query = "UPDATE user SET
            foto = '$foto',
            first_name = '$first_name',
            last_name = '$last_name',
            email = '$email'
            WHERE id_user = $id_user";
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang melakukan query UPDATE pada database
    return mysqli_affected_rows($conn);
}



?>