<?php
require('db.php');
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("location: " . 'index.html');
}

// $sql = $conn->prepare("SELECT id FROM users WHERE name = ?");

// if($sql->execute(['ivan'])){
//     if($sql->rowCount() == 1){
//         echo "name already taken!";
//         $username_err = "This username is already taken.";
//     } else{
//         echo "it is possible!";
//         // $username = trim($_POST["username"]);
//     }
// } else{
//     echo "Oops! Something went wrong. Please try again later.";
// }


// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = $conn->prepare("SELECT id FROM " . $users_table . " WHERE name = ?");

        // Set parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if ($sql->execute([$param_username])) {
            if ($sql->rowCount() == 1) {
                $username_err = "This username is already taken.";
            } else {
                $username = trim($_POST["username"]);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }


        // Close statement
        unset($sql);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database 
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = $conn->prepare("INSERT INTO " . $users_table . " (name, password) VALUES (?, ?)");

        // Set parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        // Attempt to execute the prepared statement
        if ($sql->execute([$param_username, $param_password])) {
            // Redirect to login page
            header("location: index.html");
        } else {
            echo "Something went wrong. Please try again later.";
        }


        // Close statement
        unset($sql);
    } else {
        echo "Username already taken";
    }
}
