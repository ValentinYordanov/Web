// const url = 'getImages.php'

var images;
var global_album;

function getImages(album) {
    global_album = album;
    var myImages = document.getElementById("images");
    var currentAlbum = document.getElementById("current-album");
    while (currentAlbum.firstChild) {
        currentAlbum.removeChild(currentAlbum.firstChild);
    }
    while (myImages.firstChild) {
        myImages.removeChild(myImages.firstChild);
    }

    //reseting the files for upload, so if some1 press submit button after showing album, it doesn't do anything.
    document.getElementById('file-catcher').reset();
    fileList = null;

    var request = new XMLHttpRequest();

    request.onload = function () {
        var images = JSON.parse(request.responseText);
        var album = document.createElement('h1');
        album.appendChild(document.createTextNode(global_album));

        var div = document.getElementById("current-album");
        div.appendChild(album);

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

function getCurrentAlbum() {

    var xhr = new XMLHttpRequest();
    var result;
    xhr.onload = function () {
        console.log(xhr.responseText);
        return xhr.responseText;
    }

    xhr.open('GET', 'getCurrentAlbum.php');
    xhr.send();

}