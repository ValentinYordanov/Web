function createAlbum(album_name) {
    var xhr = new XMLHttpRequest();
    var formData = new FormData();

    xhr.onload = function () {
        if (xhr.status === 400) {
            alert("Album already exists!");
        } else {
            sessionStorage.setItem('global_album', album_name);
        }

        window.location.replace("index.html");
    }

    formData.append('album', album_name);

    xhr.open('POST', 'php/addAlbum.php');
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

    xhr.open('POST', 'php/deleteAlbum.php');
    xhr.send(formData);
}