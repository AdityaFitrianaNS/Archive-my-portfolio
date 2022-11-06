const title = document.querySelector("#title");
const slug = document.querySelector("#slug");

title.addEventListener("keyup", function() {
    let preslug = title.value;
    preslug = preslug.replace(/ /g, "-");
    slug.value = preslug.toLowerCase();
});

document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
});

function previewImage() {
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');
    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;

    imgPreview.style.display = 'block';
}