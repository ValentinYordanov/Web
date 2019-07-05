var request = new XMLHttpRequest();

request.onload = function () {
    if (!request.responseText) {
        window.location.replace("login.html");
    }
}
request.open("GET", 'php/isLogged.php');
request.send();
getAlbums();