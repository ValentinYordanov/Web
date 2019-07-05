var albums;
function getAlbums() {
    var request = new XMLHttpRequest();

    request.onload = function () {
        var albums = JSON.parse(request.responseText);
        for (let i = 0; i < albums.length; i++) {
            var album = document.getElementsByClassName("album");
            if (albums[i]['name']) {
                for (var j = 0; j < album.length; j++) {
                    album[j].options[album[j].options.length] = new Option(albums[i]['name'], albums[i]['name']);
                }
            }
        }
    }

    request.open("GET", 'php/getAlbums.php');
    request.send();
}