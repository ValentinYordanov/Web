<?php
session_start();
if (isset($_SESSION['album'])) {
    echo $_SESSION['album'];
}
