<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Wuthering Waves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="card">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-2">Crear Cuenta</h2>
                    <p class="text-muted">Wuthering Waves CRUD</p>
                </div>
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        <?php 
                        switch($_GET['error']) {
                            case 'usuario_existente': echo "El usuario ya existe"; break;
                            case 'email_existente': echo "El email ya está registrado"; break;
                            case 'password_mismatch': echo "Las contraseñas no coinciden"; break;
                            default: echo "Error en el registro";
                        }
                        ?>
                    </div>
                <?php endif; ?>
                <form action="registro_action.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nombre de Usuario *</label>
                        <input type="text" name="nombre_usuario" class="form-control" required pattern="[A-Za-z0-9_]{3,50}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico *</label>
                        <input type="email" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña *</label>
                        <input type="password" name="contrasena" class="form-control" required minlength="6">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Repetir Contraseña *</label>
                        <input type="password" name="contrasena2" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Registrarse</button>
                </form>
                <p class="mt-3 text-center">
                    ¿Ya tienes cuenta? <a href="login.php" class="text-decoration-none">Inicia sesión</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>