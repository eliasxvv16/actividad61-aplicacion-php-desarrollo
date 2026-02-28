<?php
require_once 'config.php';
$nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';
$contrasena2 = $_POST['contrasena2'] ?? '';
if ($contrasena !== $contrasena2) {
    header("Location: registro.php?error=password_mismatch");
    exit();
}
$password_hash = password_hash($contrasena, PASSWORD_DEFAULT);
$conn = conectarBD();
$stmt = $conn->prepare("SELECT nombre_usuario, correo FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
$stmt->bind_param("ss", $nombre_usuario, $correo);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $existing = $result->fetch_assoc();
    if ($existing['nombre_usuario'] === $nombre_usuario) {
        header("Location: registro.php?error=usuario_existente");
    } else {
        header("Location: registro.php?error=email_existente");
    }
    exit();
}
$stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre_usuario, $password_hash, $correo);
if ($stmt->execute()) {
    header("Location: login.php?registrado=1");
} else {
    header("Location: registro.php?error=1");
}
?>