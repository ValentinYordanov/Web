function createAlbum(album_name) {
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    xhr.onload = function () {
        window.location.replace("index.html");
    }

    formData.append('album', album_name);

    xhr.open('POST', 'addAlbum.php');
    xhr.send(formData);
}