// const url = 'getImages.php'

var images;
var global_album;
function getImages(album) {
    global_album = album;
    var myImages = document.getElementById("images");
    while (myImages.firstChild) {
        myImages.removeChild(myImages.firstChild);
    }

    //reseting the files for upload, so if some1 press submit button after showing album, it doesn't do anything.
    document.getElementById('file-catcher').reset();
    fileList = null;

    var request = new XMLHttpRequest();

    request.onload = function () {
        var images = JSON.parse(request.responseText);
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
    // var imageURLs = ["http://localhost/Web/images/kitten1.jpg", "http://localhost/Web/images/kitten2.jpg", "http://localhost/Web/images/kitten3.jpg"]

// for (let i = 0; i < imageURLs.length; i++) {
//     var img = document.createElement("img");

//     img.src = imageURLs[i];
//     var src = document.getElementById("images");

//     src.appendChild(img);
// }