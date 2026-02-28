<?php
require_once 'config.php';
verificarLogin();
$nombre = trim($_POST['nombre'] ?? '');
$arma = $_POST['arma'] ?? '';
$elemento = $_POST['elemento'] ?? '';
$rareza = (int)($_POST['rareza'] ?? 4);
$rol = $_POST['rol'] ?? '';
$faccion = $_POST['faccion'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$imagen_url = $_POST['imagen_url'] ?? null;
$conn = conectarBD();
$stmt = $conn->prepare("SELECT personaje_id FROM personajes WHERE nombre = ?");
$stmt->bind_param("s", $nombre);
$stmt->execute();
if ($stmt->get_result()->num_rows > 0) {
    header("Location: add.php?error=duplicado");
    exit();
}
$stmt = $conn->prepare("INSERT INTO personajes (nombre, arma, elemento, rareza, rol, faccion, descripcion, imagen_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssissis", $nombre, $arma, $elemento, $rareza, $rol, $faccion, $descripcion, $imagen_url);
if ($stmt->execute()) {
    header("Location: home.php?success=1");
} else {
    header("Location: add.php?error=1");
}
?>