<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wuthering Waves CRUD</title>
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
                    <h2 class="fw-bold mb-2">Wuthering Waves</h2>
                    <p class="text-muted">Gestión de Personajes</p>
                </div>
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger">Credenciales incorrectas</div>
                <?php endif; ?>
                <?php if(isset($_GET['registrado'])): ?>
                    <div class="alert alert-success">✅ Registro exitoso. Inicia sesión</div>
                <?php endif; ?>
                <form action="login_action.php" method="POST">
                    <div class="mb-4">
                        <label class="form-label">Usuario o Email</label>
                        <input type="text" name="login_usuario" class="form-control" required placeholder="Introduce tu usuario">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="login_contrasena" class="form-control" required placeholder="Introduce tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Iniciar Sesión</button>
                </form>
                <div class="text-center">
                    <p class="text-muted mb-0">¿No tienes cuenta? <a href="registro.php" class="text-decoration-none fw-semibold">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>