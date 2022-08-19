# Animedit

## Deskripsi

Website yang dibuat sebagai bahan latihan hasil belajar dari berbagai sumber, dan  memiliki fitur CRUD (Create, Read, Update, Delete). Halaman yang tersedia dimulai dari <a href="https://web-animedit.netlify.app/">Landing Page </a>, Login, Registrasi akun, Waifu, Anime, All waifu, All anime, dan Profile user.

Halaman Waifu dan Anime :
- User mempunya ruang tersendiri, sehingga user lain tidak bisa mengaksesnya
- CRUD (Create, Read, Update, Delete)

Halaman All Waifu dan All Anime :
- User bisa melihat hasil postingan dari user lain
- Fitur Pencarian

Halaman Profile :
- Profile adalah akun user ketika login
- Bisa melakukan perubahan pada data akun user


### Cara penggunaan lewat ZIP pada Github

Pastikan sudah terinstall code editor, XAMPP, dan PHP versi 8

Jika dari github : 

- Pilih button `code` yang berwarna hijau
- Pada dropdown, pilih `download zip`
- Setelah terdownload, extract file kedalam folder `htdocs` yang ada pada folder local
- Setelah di extract, buat database pada phpmyadmin, dengan nama **db_animedit**
- Masuk ke database **db_animedit**
- Pada bagian atas ada `import`, klik import
- Pada form upload file, `import` file sql **db_animedit** yang ada pada hasil extract di `htdocs`
- Scroll kebawah akan ada button import, klik `import`
- Tunggu proses import file sql
- Jika berhasil, maka akan ada tabel yang muncul ketika sudah selesai di import ke database **db_animedit**
- Silahkan jalankan websitenya sesuai dengan penempatan file path di folder `htdocs` masing-masing device.

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
- 25 Juli 2022
