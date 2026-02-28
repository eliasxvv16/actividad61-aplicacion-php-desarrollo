<?php
require_once 'config.php';
$login = trim($_POST['login_usuario'] ?? '');
$password = $_POST['login_contrasena'] ?? '';
$conn = conectarBD();
$stmt = $conn->prepare("SELECT usuario_id, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = ? OR correo = ?");
$stmt->bind_param("ss", $login, $login);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['contrasena'])) {
        $_SESSION['usuario_id'] = $user['usuario_id'];
        $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
        header("Location: home.php");
        exit();
    }
}
header("Location: login.php?error=1");
?>