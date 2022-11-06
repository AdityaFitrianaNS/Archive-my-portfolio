<?php

// Koneksi ke database dengan global variabel $conn
$conn = mysqli_connect("localhost","root","","db_animedit");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($card = mysqli_fetch_assoc($result)) {
        $rows[] = $card;
    }

    return $rows;
}

function postWaifu($postWaifu) {
    global $conn;
    $nama = htmlspecialchars(stripslashes($postWaifu['nama']));
    $anime = htmlspecialchars(stripslashes($postWaifu['anime']));
    $gender = htmlspecialchars(stripslashes($postWaifu['gender']));
    $posted_by = htmlspecialchars(stripslashes($postWaifu['posted_by']));
    $deskripsi = htmlspecialchars(stripslashes($postWaifu['deskripsi']));
    $id_user = htmlspecialchars(stripslashes($postWaifu['id_user']));

    $validasi_nama = mysqli_query($conn, "SELECT nama FROM waifu_user WHERE nama = '$nama'");

    if (mysqli_fetch_assoc($validasi_nama)) { 
        echo "<script>
        alert('Nama karakter sudah ada!');
        </script>";

        // Mengembalikan nilai agar insert gagal
        return false;
    }

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // insert/tambah data
    $query = "INSERT INTO waifu_user VALUES(
            '','$gambar','$nama','$anime','$gender','$posted_by', now(),'$deskripsi','$id_user')";
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang melakukan query INSERT pada database
    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    
    // Cek gambar di upload atau tidak
    if($error === 4) {
        echo "<script>
        alert('Gagal, gambar tidak di upload');
        </script>";
        return false;
    }

    // Cek format yang diupload adalah gambar format .jpg, .jpeg, .png
    $formatGambarValid = ['jpg','jpeg','png'];
    $formatGambar = explode('.', $namaFile);
    $formatGambar = strtolower(end($formatGambar));
    if(!in_array($formatGambar, $formatGambarValid)) {
        echo "<script>
        alert('Pilih format Gambar jpg/jpeg/png');
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
    
    // Lolos cek file, maka akan generate nama pada file.
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $formatGambar;
    move_uploaded_file($tmpName, '../../public/img/upload_waifu/' . $namaFileBaru);
    
    return $namaFileBaru;
}

function updateWaifu($updateWaifu) {
    global $conn;
    $id_waifu = $updateWaifu['id_waifu'];
    $nama = htmlspecialchars(stripslashes($updateWaifu['nama']));   
    $anime = htmlspecialchars(stripslashes($updateWaifu['anime']));
    $deskripsi = htmlspecialchars(stripslashes($updateWaifu['deskripsi']));
    $gambar_lama = htmlspecialchars(stripslashes($updateWaifu['gambar_lama']));

    if ($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload();
    }
    
    $query = "UPDATE waifu_user SET
            gambar = '$gambar',
            nama = '$nama',
            anime = '$anime',
            deskripsi = '$deskripsi'
            WHERE id_waifu = $id_waifu";
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang melakukan query UPDATE pada database
    return mysqli_affected_rows($conn);
}

// Fungsi untuk hapus data
function deleteWaifu($id_waifu) {
    global $conn;
    mysqli_query($conn, "DELETE FROM waifu_user WHERE id_waifu = $id_waifu");

    // Kembalikan jumlah baris yang melakukan query DELETE pada database
    return mysqli_affected_rows($conn);
}

// Fungsi untuk mencari (keyword)
function searchWaifu($keyword) {
    $query = "SELECT * FROM waifu_user WHERE
            nama LIKE '%$keyword%' OR
            anime LIKE '%$keyword%' OR
            posted_by LIKE '%$keyword%'
            ";
    // Kembalikan nilai ke variabel query
    return query($query);
}
?>