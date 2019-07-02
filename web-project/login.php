<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.html");
    exit;
}

// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

                        // Redirect user to welcome page
                        header("location: index.html");
                    } else {
                        // Display an error message if password is not valid
                        $password_err = "The password you entered was not valid.";
                        echo "The password you entered was not valid.";
                    }
                }
            } else {
                // Display an error message if username doesn't exist
                $username_err = "No account found with that username.";
                echo "No account found with that username.";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }


        // Close statement
        unset($stmt);
    }
}
