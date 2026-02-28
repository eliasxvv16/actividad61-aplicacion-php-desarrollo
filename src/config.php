<?php
session_start();

define('DB_HOST', getenv('MARIADB_HOST') ?: 'mariadb');
define('DB_NAME', getenv('MARIADB_DATABASE') ?: 'wutheringwaves');
define('DB_USER', getenv('MARIADB_USER') ?: 'usuarioelha');
define('DB_PASS', getenv('MARIADB_PASSWORD') ?: 'eliashalloumi@2005');

function conectarBD() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("❌ Error de conexión: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>