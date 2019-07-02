var albums;
fetch('getAlbums.php')
    .then(response => response.json())
    .then(data => albums = data)
    .then(() => {
        for (let i = 0; i < albums.length; i++) {
            var album = document.getElementById("album");

            album.options[album.options.length] = new Option(albums[i]['name'], albums[i]['name']);


            // album.value = albums[i]['name'];
            // var src = document.getElementById("album");

            // src.appendChild(album);
        }
        // console.log(JSON.stringify(albums));
    });