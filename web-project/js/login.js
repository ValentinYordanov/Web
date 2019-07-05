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

    xhr.open("POST", "php/login.php");
    xhr.send(fd);
}

function register() {
    var xhr = new XMLHttpRequest();
    var fd = new FormData();

    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Successful registration!');
            window.location.replace("index.html");
        } else if (xhr.status === 400) {
            var errors = JSON.parse(xhr.responseText);
            document.getElementById('error-message-username').style.display = 'none';
            document.getElementById('error-message-password').style.display = 'none';
            document.getElementById('error-message-password-confirm').style.display = 'none';

            var error_type = errors['error'];

            if (error_type === 'username') {
                document.getElementById('error-message-username').style.display = 'block';
            } else if (error_type === 'password') {
                document.getElementById('error-message-password').style.display = 'block';
            } else if (error_type === 'password-confirm') {
                document.getElementById('error-message-password-confirm').style.display = 'block';
            }
        }
    }

    fd.append('username', document.getElementById('input-username').value);
    fd.append('password', document.getElementById('input-password').value);
    fd.append('confirm_password', document.getElementById('input-password-confirm').value);

    xhr.open("POST", "php/register.php");
    xhr.send(fd);
}