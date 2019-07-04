var albums;
function getAlbums() {
    fetch('getAlbums.php')
        .then(response => response.json())
        .then(data => albums = data)
        .then(() => {
            for (let i = 0; i < albums.length; i++) {
                var album = document.getElementsByClassName("album");
                if (albums[i]['name']) {
                    for (var j = 0; j < album.length; j++) {
                        album[j].options[album[j].options.length] = new Option(albums[i]['name'], albums[i]['name']);
                    }
                }
            }
            // document.getElementsByClassName('album')[0].value = albums[albums.length - 1]['album'];
            // document.getElementsByClassName('album')[1].value = albums[albums.length - 1]['album'];
        });
}