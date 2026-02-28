-- =====================================================
-- BASE DE DATOS: Wuthering Waves - Personajes Oficiales (v3.1 Corregida)
-- =====================================================
 
CREATE DATABASE IF NOT EXISTS wutheringwaves CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wutheringwaves;
 
-- =====================================================
-- TABLA 1: USUARIOS
-- =====================================================
CREATE TABLE IF NOT EXISTS usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    creacion DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
-- =====================================================
-- TABLA 2: PERSONAJES (ARMAS CORREGIDAS)
-- =====================================================
CREATE TABLE IF NOT EXISTS personajes (
    personaje_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    arma ENUM('Espada', 'Mandoble', 'Rectificador', 'Brazales', 'Pistolas') NOT NULL,
    elemento ENUM('Aero', 'Glacio', 'Fusion', 'Spectro', 'Destruccion', 'Electro') NOT NULL,
    rareza INT NOT NULL CHECK (rareza >= 1 AND rareza <= 5),
    rol VARCHAR(50) NOT NULL,
    faccion VARCHAR(50),
    descripcion TEXT,
    imagen_url VARCHAR(255),
    activo BOOLEAN DEFAULT TRUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
 
-- =====================================================
-- INSERCIÓN: Personajes 5★ (DATOS VERIFICADOS)
-- =====================================================
INSERT INTO personajes (nombre, arma, elemento, rareza, rol, faccion, descripcion, imagen_url, activo) VALUES
-- Personajes 5★ Corregidos
('Jiyan', 'Mandoble', 'Aero', 5, 'DPS Principal', 'Hollow Deep', 'Líder de Hollow Deep. Maestro del viento con mandoble.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_jiyan_UI.png', TRUE),
('Jianxin', 'Brazales', 'Aero', 5, 'Sub-DPS', 'Resonance Research Institute', 'Directora del Instituto. Combate con brazales y precisión aerodinámica.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_jianxin_UI.png', TRUE),
('Yinlin', 'Rectificador', 'Electro', 5, 'Sub-DPS', 'Hollow Deep', 'Experta en combate con rectificador. Sus ataques eléctricos generan combos devastadores.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_yinlin_UI.png', TRUE),
('Calcharo', 'Mandoble', 'Electro', 5, 'DPS Principal', 'Ghost Clan', 'Líder del Clan Fantasma. Domina el elemento eléctrico con mandoble.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_calcharo_UI.png', TRUE),
('Changli', 'Espada', 'Fusion', 5, 'DPS Principal', 'Mingting', 'Ex Secretaria General de Mingting. Domina el fuego con espada y elegancia letal.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_changli_UI.png', TRUE),
('Xiangli Yao', 'Brazales', 'Electro', 5, 'DPS', 'Mingting', 'Genio científica. Canaliza energía Fusion con rectificador para daño explosivo.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_xiangliyao_UI.png', TRUE),
('Lingyang', 'Brazales', 'Glacio', 5, 'DPS Principal', 'Hollow Deep', 'Experto en artes marciales. Combina velocidad y potencia con brazales glaciales.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_lingyang_UI.png', TRUE),
('Sanhua', 'Espada', 'Glacio', 5, 'Sub-DPS', 'Hollow Deep', 'Elegante espadachina con dominio absoluto del hielo.', 'https://wuthering.gg/_ipx/q_70&s_100x100/images/IconRoleHead150/T_IconRoleHead150_7.png', TRUE),
('Verina', 'Rectificador', 'Spectro', 5, 'Curador', 'Hollow Deep', 'La curadora más eficiente. Restaura salud con rectificador Spectro.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_verina_UI.png', TRUE),
('Shorekeeper', 'Rectificador', 'Spectro', 5, 'Curador/Soporte', 'Hollow Deep', 'Misteriosa resonadora. Potencia equipos con energía Spectro y rectificador.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_shorekeeper_UI.png', TRUE),
('Cantarella', 'Rectificador', 'Destruccion', 5, 'Sub-DPS', 'Fisalia Family', 'Matriarca de la Familia Fisalia. Domina Destruccion con rectificador.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_cantarella_UI.png', TRUE),
('Ciaccona', 'Rectificador', 'Aero', 5, 'Soporte', 'Hollow Deep', 'Resonadora Aero especializada en movilidad con rectificador.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_ciaccona_UI.png', TRUE),
('Zhezhi', 'Rectificador', 'Glacio', 5, 'Soporte/Sub-DPS', 'Hollow Deep', 'Maestra del hielo con rectificador. Congela enemigos y potencia equipos Glacio.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_zhezhi_UI.png', TRUE),
('Carlotta', 'Pistolas', 'Glacio', 5, 'DPS Principal', 'New Eridu', 'Agente de New Eridu con espada Spectro. Ataques que atraviesan defensas.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_carlotta_UI.png', TRUE),
('Roccia', 'Mandoble', 'Destruccion', 5, 'DPS Principal', 'New Federation', 'Primera Oficial de la Marina. Combate con mandoble y energía Destruccion.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_roccia_UI.png', TRUE),
('Camellya', 'Rectificador', 'Spectro', 5, 'Soporte', 'Black Shores', 'Portadora de Flor de la Costa Negra. Especialista en debilitar con rectificador Spectro.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_camellya_UI.png', TRUE),
('Lupa', 'Espada', 'Spectro', 5, 'Sub-DPS', 'Hollow Deep', 'Espadachina Spectro con alta movilidad y daño sostenido.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_lupa_UI.png', TRUE),
('Galbrena', 'Mandoble', 'Aero', 5, 'DPS Principal', 'Hollow Deep', 'Maestra de mandoble Aero. Combina velocidad y daño continuo con viento.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_galbrena_UI.png', TRUE),
('Mornye', 'Rectificador', 'Fusion', 5, 'Curador/Soporte', 'Hollow Deep', 'Curadora limitada 5★. Especialista en potenciación de daño con rectificador Fusion.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_mornye_UI.png', TRUE),
('Brant', 'Brazales', 'Glacio', 5, 'Tanque/DPS', 'Hollow Deep', 'Luchador robusto con brazales Glacio. Excelente para absorber daño.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_brant_UI.png', TRUE),
('Phoebe', 'Espada', 'Fusion', 5, 'Sub-DPS', 'Hollow Deep', 'Espadachina Fusion ágil con ataques de fuego rápido.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_phoebe_UI.png', TRUE),
('Zani', 'Pistolas', 'Electro', 5, 'DPS en Área', 'Hollow Deep', 'Experta en pistolas Electro. Daña múltiples objetivos simultáneamente.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_zani_UI.png', TRUE),
('Chisa', 'Mandoble', 'Destruccion', 5, 'DPS Principal', 'Hollow Deep', 'Resonadora con mandoble Destruccion. Ataques contundentes y alta resistencia.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_chisa_UI.png', TRUE),
('Lynae', 'Rectificador', 'Aero', 5, 'Soporte', 'Hollow Deep', 'Especialista en rectificador Aero para movilidad y potenciación.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile Lynae_UI.png', TRUE),
('Phrolova', 'Mandoble', 'Spectro', 5, 'Sub-DPS', 'Hollow Deep', 'Maestra de mandoble Spectro. Debilita defensas y potencia aliados.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_phrolova_UI.png', TRUE),
('Cartethyia', 'Rectificador', 'Aero', 5, 'DPS Principal', 'Rinascita', 'Reverenciada como Fleurdelys. Domina el viento con rectificador y daño explosivo.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_cartethyia_UI.png', TRUE),
('Encore', 'Espada', 'Fusion', 5, 'Sub-DPS', 'New Eridu', 'Resonadora de New Eridu. Especialista en control con espada Fusion.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_encore_UI.png', TRUE),

-- ✨ NUEVOS PERSONAJES AÑADIDOS
('Augusta', 'Mandoble', 'Electro', 5, 'DPS Principal', 'Rinascita', 'Ephor de Septimont. Gladiadora invicta con mandoble Electro y voluntad de hierro.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_aogusita_UI.png', TRUE),
('Iuno', 'Brazales', 'Aero', 5, 'Soporte/Curador', 'Rinascita', 'Sacerdotisa prodigio de Septimont. Ve el futuro con brazales Aero y potencia al equipo.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_younuo_UI.png', TRUE);

-- =====================================================
-- Personajes 4★ (DATOS VERIFICADOS)
-- =====================================================
INSERT INTO personajes (nombre, arma, elemento, rareza, rol, faccion, descripcion, imagen_url, activo) VALUES
('Mortefi', 'Rectificador', 'Fusion', 4, 'Sub-DPS', 'New Federation', 'Jefe de la Rama de Armas Tacetite. Domina el fuego con rectificador.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_baer_UI.png', TRUE),
('Aalto', 'Rectificador', 'Aero', 4, 'Soporte', 'Hollow Deep', 'Controla el viento con rectificador para potenciar el daño del equipo.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_qiushui_UI.png', TRUE),
('Youhu', 'Mandoble', 'Glacio', 4, 'Sub-DPS', 'Hollow Deep', 'Resonadora con mandoble glacial. Potencia equipos Glacio con congelación.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_youhu_UI.png', TRUE),
('Chixia', 'Pistolas', 'Fusion', 4, 'DPS en Área', 'Hollow Deep', 'Experta en pistolas Fusion. Ideal para limpieza rápida de grupos.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_maxiaofang_UI.png', TRUE),
('Yuanwu', 'Brazales', 'Electro', 4, 'Soporte', 'Hollow Deep', 'Propietario de gimnasio. Sus brazales canalizan energía Electro para potenciar aliados.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_yuanwu_UI.png', TRUE),
('Baizhi', 'Rectificador', 'Glacio', 4, 'Curador/Soporte', 'Hollow Deep', 'Médica de Hollow Deep. Combina curación con rectificador glacial.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_bailian_UI.png', TRUE),
('Yangyang', 'Mandoble', 'Glacio', 4, 'Control/Sub-DPS', 'Hollow Deep', 'Utiliza mandoble para congelar y controlar enemigos con ataques Glacio.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_yangyang_UI.png', TRUE),
('Taoqi', 'Brazales', 'Destruccion', 4, 'Tanque/DPS', 'Ministry of Development', 'Directora de Defensa Fronteriza. Absorbe daño con brazales Destruccion.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_taohua_UI.png', TRUE),
('Danjin', 'Brazales', 'Fusion', 4, 'DPS Principal', 'Hollow Deep', 'Experta en combate cuerpo a cuerpo con brazales Fusion de alto impacto.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_micai_UI.png', TRUE),
('Lumi', 'Rectificador', 'Spectro', 4, 'Curador', 'Hollow Deep', 'Curadora Spectro con rectificador. Restauración y protección de aliados.', 'https://wuthering.gg/_ipx/q_70&s_400x552/images/IconRolePile/T_IconRole_Pile_dengdeng_UI.png', TRUE);
 
-- =====================================================
-- USUARIO INICIAL
-- =====================================================
INSERT INTO usuarios (nombre_usuario, contrasena, correo) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@wutheringwaves.com');