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

function postAnime($postAnime) {
    global $conn;
    $judul = htmlspecialchars(stripslashes($postAnime['judul']));
    $musim = htmlspecialchars(stripslashes($postAnime['musim']));
    $studio = htmlspecialchars(stripslashes($postAnime['studio']));
    $posted_by = htmlspecialchars(stripslashes($postAnime['posted_by']));
    $sinopsis = htmlspecialchars(stripslashes($postAnime['sinopsis']));
    $id_user = htmlspecialchars(stripslashes($postAnime['id_user']));

    $validasi_judul = mysqli_query($conn, "SELECT judul FROM anime_user WHERE judul = '$judul'");

    if (mysqli_fetch_assoc($validasi_judul)) { 
        echo "<script>
        alert('Siswa sudah terdaftar!');
        </script>";

        // Mengembalikan nilai agar insert gagal
        return false;
    }

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // insert atau tambah data
    $query = "INSERT INTO anime_user VALUES('','$gambar','$judul','$musim','$studio','$posted_by',now(),'$sinopsis','$id_user')";
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
    move_uploaded_file($tmpName, '../../public/img/upload_anime/' . $namaFileBaru);

    return $namaFileBaru;
}

function updateAnime($updateAnime) {
    global $conn;
    $id_anime = $updateAnime['id_anime'];
    $judul = htmlspecialchars(stripslashes($updateAnime['judul']));
    $studio = htmlspecialchars(stripslashes($updateAnime['studio']));
    $sinopsis = htmlspecialchars(stripslashes($updateAnime['sinopsis']));
    $gambar_lama = htmlspecialchars(stripslashes($updateAnime['gambar_lama']));

    if ($_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambar_lama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE anime_user SET
            gambar = '$gambar',
            judul = '$judul',
            studio = '$studio',
            sinopsis = '$sinopsis'
            WHERE id_anime = $id_anime";
    mysqli_query($conn, $query);

    // Kembalikan jumlah baris yang melakukan query UPDATE pada database
    return mysqli_affected_rows($conn);
}

// Fungsi untuk hapus data
function deleteAnime($id_anime) {
    global $conn;
    mysqli_query($conn, "DELETE FROM anime_user WHERE id_anime = $id_anime");

    // Kembalikan jumlah baris yang melakukan query DELETE pada database
    return mysqli_affected_rows($conn);
}

// Fungsi untuk mencari (keyword)
function searchAnime($keyword) {
    $query = "SELECT * FROM anime_user WHERE
        judul LIKE '%$keyword' OR
        musim LIKE '%$keyword' OR
        posted_by LIKE '%$keyword'
        ";
    // Kembalikan fungsi query ke variabel query
    return query($query);
}

?>