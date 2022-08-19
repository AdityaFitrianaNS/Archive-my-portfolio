# InventoriID

## Deskripsi

Website ini dibuat untuk mengolah data gudang penyimpanan barang dan dibuat sebagai pertemuan terakhir matakuliah pemrograman web lanjut. Halaman yang tersedia dimulai dari Landing Page, Login, Registrasi akun, Home, Stok barang, Barang masuk, Barang keluar, Laporan, dan User.

## Fitur Halaman

Stok barang, Barang masuk, dan Barang keluar :
- Menambahkan data barang
- Membaca data barang
- Menghapus data barang
- Mengubah data barang
- Melakukan pencarian data barang
  
Halaman Laporan :
- Menampilkan relasi antar tabel stok barang, barang masuk, dan barang keluar

Halaman User :
- Melihat user yang login pada halaman website


### Cara penggunaan lewat ZIP pada Github

Pastikan sudah terinstall code editor, XAMPP, dan PHP versi 8

Jika dari github : 

- Pilih button `code` yang berwarna hijau
- Pada dropdown, pilih `download zip`
- Setelah terdownload, extract file kedalam folder `htdocs` yang ada pada folder local
- Setelah di extract, buat database pada phpmyadmin, dengan nama **db_inventory**
- Masuk ke database **db_inventory**
- Pada bagian atas ada `import`, klik import
- Pada form upload file, `import` file sql **db_inventory** yang ada pada hasil extract di `htdocs`
- Scroll kebawah akan ada button import, klik `import`
- Tunggu proses import file sql
- Jika berhasil, maka akan ada tabel yang muncul ketika sudah selesai di import ke database **db_inventory**
- Silahkan jalankan websitenya di `localhost` sesuai dengan penempatan file path folder `htdocs` masing-masing device.

### Teknologi yang dipakai

- HTML5
- CSS3
- Bootstrap 5
- Javascript
- PHP8
- MySQL 
- Sweetalert 2 (Library)

Localhost :
- XAMPP (Untuk mengaktifkan localhost)

Code editor :
- Visual Studio Code

### Tanggal Selesai
- 1 Juli 2022

