<?php
require("db.php");
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.html");
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = $conn->prepare("SELECT id, name, password FROM " . $users_table . " WHERE name = ?");

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if ($sql->execute([$param_username])) {
            // Check if username exists, if yes then verify password
            if ($sql->rowCount() == 1) {
                if ($row = $sql->fetch()) {
                    $id = $row["id"];
                    $username = $row["name"];
                    $hashed_password = $row["password"];
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, so start a new session
                        session_start();

                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["user"] = $username;

                        http_response_code(200);
                        exit;
                    } else {
                        // Display an error message if password is not valid
                        http_response_code(400);
                        exit;
                    }
                }
            } else {
                // Display an error message if username doesn't exist
                http_response_code(400);
                exit;
            }
        } else {
            http_response_code(400);
            exit;
        }
    }
}
