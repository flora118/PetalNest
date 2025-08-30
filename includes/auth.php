<?php
function require_login() {
    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }
}

function require_admin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
        header("Location: login.php");
        exit;
    }
}
?>