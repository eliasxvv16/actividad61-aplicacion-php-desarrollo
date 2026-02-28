<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: home.php");
} else {
    header("Location: login.php");
}
?>