<?php require_once 'config.php'; verificarLogin(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Personaje - Wuthering Waves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg"><div class="container"><a class="navbar-brand" href="home.php">Wuthering Waves</a></div></nav>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header"><h4 class="mb-0">➕ Nuevo Personaje</h4></div>
                <div class="card-body p-4">
                    <?php if(isset($_GET['error'])): ?><div class="alert alert-danger"><?= $_GET['error']=='duplicado'?'⚠️ Ya existe un personaje con este nombre':'Error al guardar' ?></div><?php endif; ?>
                    <form action="add_action.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-4"><label class="form-label">Nombre *</label><input type="text" name="nombre" class="form-control" required maxlength="100" placeholder="Nombre del personaje"></div>
                            <div class="col-md-3 mb-4"><label class="form-label">Arma *</label><select name="arma" class="form-select" required><option value="">Seleccionar...</option><?php foreach(['Espada','Puños','Pistolas','Catalizador','Hoja'] as $arma): ?><option value="<?= $arma ?>"><?= $arma ?></option><?php endforeach; ?></select></div>
                            <div class="col-md-3 mb-4"><label class="form-label">Elemento *</label><select name="elemento" class="form-select" required><option value="">Seleccionar...</option><?php foreach(['Aero','Glacio','Fusion','Spectro','Destruccion','Electro'] as $elem): ?><option value="<?= $elem ?>"><?= $elem ?></option><?php endforeach; ?></select></div>
                            <div class="col-md-3 mb-4"><label class="form-label">Rareza *</label><select name="rareza" class="form-select" required><option value="5">⭐⭐⭐⭐⭐ (5★)</option><option value="4">⭐⭐⭐⭐ (4★)</option></select></div>
                            <div class="col-md-5 mb-4"><label class="form-label">Rol *</label><input type="text" name="rol" class="form-control" required placeholder="Ej: DPS Principal"></div>
                            <div class="col-md-4 mb-4"><label class="form-label">Facción</label><input type="text" name="faccion" class="form-control" placeholder="Ej: Hollow Deep"></div>
                            <div class="col-12 mb-4"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="3" placeholder="Descripción del personaje"></textarea></div>
                            <div class="col-12 mb-4"><label class="form-label">URL de Imagen</label><input type="url" name="imagen_url" class="form-control" placeholder="https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_jiyan_UI.png"><small class="text-muted">Ejemplo: https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_{nombre}_UI.png</small></div>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="home.php" class="btn btn-secondary">Cancelar</a>
                            <button type="reset" class="btn btn-secondary">Limpiar</button>
                            <button type="submit" class="btn btn-success">💾 Guardar Personaje</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>