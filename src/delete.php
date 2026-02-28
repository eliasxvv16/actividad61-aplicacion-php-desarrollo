<?php
require_once 'config.php';
verificarLogin();
$id = (int)($_GET['id'] ?? 0);
if ($id > 0) {
    $conn = conectarBD();
    $stmt = $conn->prepare("DELETE FROM personajes WHERE personaje_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: home.php?deleted=1");
?>