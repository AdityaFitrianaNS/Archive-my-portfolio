var keyword = document.getElementById('keyword');
var tombol_cari = document.getElementById('tombol_cari');
var card_container = document.getElementById('card_container');

// Menambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function(){
    // Membuat objext AJAX
    var xhr = new XMLHttpRequest();

    // Cek kesiapan AJAX
    xhr.onreadystatechange = function() {
        if ( xhr.readyState == 4 && xhr.status == 200) {
            card_container.innerHTML = xhr.responseText;
        }
    }

    // Eksekusi AJAX
    xhr.open('GET','../../../public/ajax/ajax_waifu.php?keyword=' + keyword.value, true);
    xhr.send();
});