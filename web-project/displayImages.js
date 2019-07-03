// const url = 'getImages.php'

var images;
function getImages(album) {
    var myImages = document.getElementById("images");
    while (myImages.firstChild) {
        myImages.removeChild(myImages.firstChild);
    }

    fetch('getImages.php/?album=' + album)
        .then(response => response.json())
        .then(data => images = data)
        .then(() => {
            for (let i = 0; i < images.length; i++) {
                var img = document.createElement("img");

                img.src = "http://localhost/Web/images/" + images[i]['path'];
                var src = document.getElementById("images");
                // console.log("some things never change");
                src.appendChild(img);
            }
        });
}
    // var imageURLs = ["http://localhost/Web/images/kitten1.jpg", "http://localhost/Web/images/kitten2.jpg", "http://localhost/Web/images/kitten3.jpg"]

// for (let i = 0; i < imageURLs.length; i++) {
//     var img = document.createElement("img");

//     img.src = imageURLs[i];
//     var src = document.getElementById("images");

//     src.appendChild(img);
// }