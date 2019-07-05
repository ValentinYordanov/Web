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

function deleteAlbum(album_name) {
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    xhr.onload = function () {
        if (sessionStorage.getItem('global_album') === album_name) {
            sessionStorage.removeItem('global_album');
        }
        window.location.replace("index.html");
    }

    formData.append('album', album_name);

    xhr.open('POST', 'deleteAlbum.php');
    xhr.send(formData);
}