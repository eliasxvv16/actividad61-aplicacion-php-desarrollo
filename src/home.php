<?php
require_once 'config.php';
verificarLogin();
$conn = conectarBD();
$pagina = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$por_pagina = 9;
$offset = ($pagina - 1) * $por_pagina;
$filtro_elemento = $_GET['elemento'] ?? '';
$filtro_rareza = $_GET['rareza'] ?? '';
$filtro_busqueda = $_GET['busqueda'] ?? '';
$sql = "SELECT * FROM personajes WHERE 1=1";
$params = [];
$types = "";
if ($filtro_elemento) { $sql .= " AND elemento = ?"; $params[] = $filtro_elemento; $types .= "s"; }
if ($filtro_rareza) { $sql .= " AND rareza = ?"; $params[] = $filtro_rareza; $types .= "i"; }
if ($filtro_busqueda) { $sql .= " AND (nombre LIKE ? OR descripcion LIKE ?)"; $busqueda = "%$filtro_busqueda%"; $params[] = $busqueda; $params[] = $busqueda; $types .= "ss"; }
$sql_count = $sql;
$sql .= " ORDER BY rareza DESC, nombre LIMIT ? OFFSET ?";
$params[] = $por_pagina; $params[] = $offset; $types .= "ii";
$stmt = $conn->prepare($sql);
if ($types) $stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$total_stmt = $conn->prepare("SELECT COUNT(*) as total FROM personajes WHERE 1=1" . 
    ($filtro_elemento ? " AND elemento = ?" : "") . 
    ($filtro_rareza ? " AND rareza = ?" : "") . 
    ($filtro_busqueda ? " AND (nombre LIKE ? OR descripcion LIKE ?)" : ""));
if ($filtro_elemento && $filtro_rareza && $filtro_busqueda) {
    $total_stmt->bind_param("siss", $filtro_elemento, $filtro_rareza, $busqueda, $busqueda);
} elseif ($filtro_elemento && $filtro_rareza) {
    $total_stmt->bind_param("si", $filtro_elemento, $filtro_rareza);
} elseif ($filtro_elemento && $filtro_busqueda) {
    $total_stmt->bind_param("sss", $filtro_elemento, $busqueda, $busqueda);
} elseif ($filtro_rareza && $filtro_busqueda) {
    $total_stmt->bind_param("iss", $filtro_rareza, $busqueda, $busqueda);
} elseif ($filtro_elemento) {
    $total_stmt->bind_param("s", $filtro_elemento);
} elseif ($filtro_rareza) {
    $total_stmt->bind_param("i", $filtro_rareza);
} elseif ($filtro_busqueda) {
    $total_stmt->bind_param("ss", $busqueda, $busqueda);
}
$total_stmt->execute();
$total = $total_stmt->get_result()->fetch_assoc()['total'];
$total_paginas = ceil($total / $por_pagina);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personajes - Wuthering Waves CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Wuthering Waves</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><span class="nav-link">Hola, <?= htmlspecialchars($_SESSION['nombre_usuario']) ?></span></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div class="page-header">
        <h1 class="page-title">Personajes</h1>
    </div>
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">✅ Operación realizada con éxito<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>
    <?php if(isset($_GET['deleted'])): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">🗑️ Personaje eliminado correctamente<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    <?php endif; ?>
    <div class="filtros-container">
        <form method="GET" class="row g-3">
            <div class="col-md-4"><input type="text" name="busqueda" class="form-control" placeholder="🔍 Buscar personaje..." value="<?= htmlspecialchars($filtro_busqueda) ?>"></div>
            <div class="col-md-3">
                <select name="elemento" class="form-select">
                    <option value="">Todos los elementos</option>
                    <?php foreach(['Aero','Glacio','Fusion','Spectro','Destruccion','Electro'] as $elem): ?>
                        <option value="<?= $elem ?>" <?= $filtro_elemento===$elem?'selected':'' ?>><?= $elem ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <select name="rareza" class="form-select">
                    <option value="">Todas</option>
                    <option value="5" <?= $filtro_rareza==='5'?'selected':'' ?>>5 Estrellas</option>
                    <option value="4" <?= $filtro_rareza==='4'?'selected':'' ?>>4 Estrellas</option>
                </select>
            </div>
            <div class="col-md-3">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">Filtrar</button>
                    <a href="home.php" class="btn btn-secondary">Limpiar</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row g-4">
        <?php while($p = $result->fetch_assoc()): ?>
        <div class="col-md-6 col-lg-4">
            <div class="personaje-card elemento-<?= htmlspecialchars($p['elemento']) ?>">
                <div class="personaje-imagen-container">
                    <div class="rareza-badge rareza-<?= $p['rareza'] ?>"><?= str_repeat('★', $p['rareza']) ?></div>
                    <?php if($p['imagen_url']): ?>
                        <img src="<?= htmlspecialchars($p['imagen_url']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>" class="personaje-imagen" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="personaje-imagen-placeholder" style="display:none;"><span style="font-size:5rem;opacity:0.3;">🎮</span><p class="text-muted mt-3">Sin imagen</p></div>
                    <?php else: ?>
                        <div class="personaje-imagen-placeholder"><span style="font-size:5rem;opacity:0.3;">🎮</span><p class="text-muted mt-3">Sin imagen</p></div>
                    <?php endif; ?>
                </div>
                <div class="personaje-info">
                    <h3 class="personaje-nombre"><?= htmlspecialchars($p['nombre']) ?></h3>
                    <div class="personaje-meta mb-3">
                        <span class="badge-elemento badge-<?= strtolower($p['elemento']) ?>"><?= htmlspecialchars($p['elemento']) ?></span>
                        <span class="badge-arma"><?= htmlspecialchars($p['arma']) ?></span>
                    </div>
                    <p class="personaje-rol mb-2"><strong style="color:#666;">Rol:</strong> <span style="color:#333;"><?= htmlspecialchars($p['rol']) ?></span></p>
                    <?php if($p['faccion']): ?><p class="personaje-faccion mb-0"><span style="color:#999;">🏷️</span> <span style="color:#666;"><?= htmlspecialchars($p['faccion']) ?></span></p><?php endif; ?>
                </div>
                <div class="personaje-footer">
                    <div class="d-flex gap-2">
                        <a href="edit.php?id=<?= $p['personaje_id'] ?>" class="btn btn-warning btn-sm flex-fill">✏️ Editar</a>
                        <a href="delete.php?id=<?= $p['personaje_id'] ?>" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('¿Eliminar <?= addslashes($p['nombre']) ?>?')">🗑️</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php if($total_paginas > 1): ?>
    <nav class="mt-5"><ul class="pagination justify-content-center">
        <?php for($i=1; $i<=$total_paginas; $i++): ?>
        <li class="page-item <?= $i==$pagina?'active':'' ?>"><a class="page-link" href="?page=<?= $i ?><?= $filtro_elemento?'&elemento='.$filtro_elemento:'' ?><?= $filtro_rareza?'&rareza='.$filtro_rareza:'' ?><?= $filtro_busqueda?'&busqueda='.urlencode($filtro_busqueda):'' ?>"><?= $i ?></a></li>
        <?php endfor; ?>
    </ul></nav>
    <?php endif; ?>
    <div class="text-center mt-4"><a href="add.php" class="btn btn-success btn-lg">➕ Añadir Nuevo Personaje</a></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>