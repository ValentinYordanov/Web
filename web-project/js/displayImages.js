// const url = 'getImages.php'

var images;
var global_album;

if (sessionStorage.getItem('global_album')) {
    getImages(sessionStorage.getItem('global_album'));
}

function getImages(album) {
    global_album = album;
    sessionStorage.setItem("global_album", global_album);

    var myImages = document.getElementById("images");
    var currentAlbum = document.getElementById("current-album");

    removeChilds(myImages);
    removeChilds(currentAlbum);

    //reseting the files for upload, so if some1 press submit button after showing album, it doesn't do anything.
    if (document.getElementById('file-catcher')) {
        document.getElementById('file-catcher').reset();
    }
    fileList = null;

    getImagesFromDB(album);
}

function removeChilds(element) {
    if (element) {
        while (element.firstChild) {
            element.removeChild(element.firstChild);
        }
    }
}

function getImagesFromDB(album) {
    var request = new XMLHttpRequest();

    request.onload = function () {
        var images = JSON.parse(request.responseText);
        //problematic?
        if (global_album != null) {
            // var album = document.createElement('h1');
            // album.appendChild(document.createTextNode(global_album));

            // var div = document.getElementById("current-album");
            // div.appendChild(album);
        }

        for (let i = 0; i < images.length; i++) {
            var img = document.createElement("img");

            img.src = "http://localhost/Web/images/" + images[i]['path'];
            var src = document.getElementById("images");
            src.appendChild(img);
        }
    }

    request.open("GET", 'getImages.php/?album=' + album);
    request.send();
}