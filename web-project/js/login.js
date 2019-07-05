function login() {
    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    xhr.onload = function () {
        if (xhr.status === 200) {
            window.location.replace("index.html");
        } else {
            document.getElementById('error-message').style.display = 'block';
        }
    }

    fd.append('username', document.getElementById('input-username').value);
    fd.append('password', document.getElementById('input-password').value);

    xhr.open("POST", "login.php");
    xhr.send(fd);
}