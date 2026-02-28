<?php
require_once 'config.php';
verificarLogin();
$conn = conectarBD();
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) { header("Location: home.php"); exit(); }
$stmt = $conn->prepare("SELECT * FROM personajes WHERE personaje_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();
if (!$p) { header("Location: home.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personaje - Wuthering Waves</title>
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
                <div class="card-header"><h4 class="mb-0">✏️ Editar: <?= htmlspecialchars($p['nombre']) ?></h4></div>
                <div class="card-body p-4">
                    <form action="edit_action.php" method="POST">
                        <input type="hidden" name="personaje_id" value="<?= $p['personaje_id'] ?>">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Nombre *</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($p['nombre']) ?>" readonly title="El nombre es UNIQUE y no se puede modificar">
                                <small class="text-muted">⚠️ El nombre no se puede modificar (campo UNIQUE)</small>
                            </div>
                            <div class="col-md-3 mb-4"><label class="form-label">Arma *</label><select name="arma" class="form-select" required><?php foreach(['Espada','Puños','Pistolas','Catalizador','Hoja'] as $arma): ?><option value="<?= $arma ?>" <?= $p['arma']===$arma?'selected':'' ?>><?= $arma ?></option><?php endforeach; ?></select></div>
                            <div class="col-md-3 mb-4"><label class="form-label">Elemento *</label><select name="elemento" class="form-select" required><?php foreach(['Aero','Glacio','Fusion','Spectro','Destruccion','Electro'] as $elem): ?><option value="<?= $elem ?>" <?= $p['elemento']===$elem?'selected':'' ?>><?= $elem ?></option><?php endforeach; ?></select></div>
                            <div class="col-md-3 mb-4"><label class="form-label">Rareza *</label><select name="rareza" class="form-select" required><option value="5" <?= $p['rareza']==5?'selected':'' ?>>⭐⭐⭐⭐⭐</option><option value="4" <?= $p['rareza']==4?'selected':'' ?>>⭐⭐⭐⭐</option></select></div>
                            <div class="col-md-5 mb-4"><label class="form-label">Rol *</label><input type="text" name="rol" class="form-control" value="<?= htmlspecialchars($p['rol']) ?>" required></div>
                            <div class="col-md-4 mb-4"><label class="form-label">Facción</label><input type="text" name="faccion" class="form-control" value="<?= htmlspecialchars($p['faccion'] ?? '') ?>"></div>
                            <div class="col-12 mb-4"><label class="form-label">Descripción</label><textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($p['descripcion'] ?? '') ?></textarea></div>
                            <div class="col-12 mb-4"><label class="form-label">URL de Imagen</label><input type="url" name="imagen_url" class="form-control" value="<?= htmlspecialchars($p['imagen_url'] ?? '') ?>"></div>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="home.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning">💾 Actualizar</button>
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