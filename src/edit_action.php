<?php
require_once 'config.php';
verificarLogin();
$id = (int)($_POST['personaje_id'] ?? 0);
if ($id <= 0) { header("Location: home.php"); exit(); }
$arma = $_POST['arma'] ?? '';
$elemento = $_POST['elemento'] ?? '';
$rareza = (int)($_POST['rareza'] ?? 4);
$rol = $_POST['rol'] ?? '';
$faccion = $_POST['faccion'] ?? null;
$descripcion = $_POST['descripcion'] ?? null;
$imagen_url = $_POST['imagen_url'] ?? null;
$conn = conectarBD();
$stmt = $conn->prepare("UPDATE personajes SET arma=?, elemento=?, rareza=?, rol=?, faccion=?, descripcion=?, imagen_url=? WHERE personaje_id=?");
$stmt->bind_param("ssissisi", $arma, $elemento, $rareza, $rol, $faccion, $descripcion, $imagen_url, $id);
if ($stmt->execute()) {
    header("Location: home.php?success=1");
} else {
    header("Location: edit.php?id=$id&error=1");
}
?>