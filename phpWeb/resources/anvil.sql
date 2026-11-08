DROP anvilDATABASE IF EXISTS anvil;
CREATE DATABASE IF NOT EXISTS anvil
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE anvil;

CREATE TABLE USUARIOS (
    id_usuario  INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(50)  NOT NULL UNIQUE,
    contrasenia VARCHAR(255) NOT NULL,          -- guardar el hash (bcrypt/argon2), nunca texto plano
    rol         VARCHAR(20)  NOT NULL DEFAULT 'usuario'
);

CREATE TABLE PERFIL_USUARIO (
    id_usuario INT PRIMARY KEY,                 -- PK y FK a la vez = relación 1:1
    nickname   VARCHAR(50)    NOT NULL UNIQUE,
    saldo      DECIMAL(10,2)  NOT NULL DEFAULT 0.00,
    CONSTRAINT fk_perfil_usuario
        FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
        ON DELETE CASCADE
);

CREATE TABLE JUEGOS (
    id_juego    INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(100)  NOT NULL,
    precio      DECIMAL(10,2) NOT NULL,
    descripcion TEXT,
    pegi        INT
);

CREATE TABLE USUARIOS_JUEGOS (
    id_usuario INT NOT NULL,
    id_juego   INT NOT NULL,
    PRIMARY KEY (id_usuario, id_juego),         -- clave compuesta
    CONSTRAINT fk_ug_usuario
        FOREIGN KEY (id_usuario) REFERENCES USUARIOS(id_usuario)
        ON DELETE CASCADE,
    CONSTRAINT fk_ug_juego
        FOREIGN KEY (id_juego) REFERENCES JUEGOS(id_juego)
        ON DELETE CASCADE
);

-- USUARIOS (1 admin + 3 usuarios)
INSERT INTO USUARIOS (id_usuario, nombre, contrasenia, rol) VALUES
(1, 'admin',  '$2y$10$HwfP3EvCdqy9RZ.X9Hvy1.eVAZ4/7jOlqaUQL1yiWyPvDW4MFuMI.',  'admin'),   -- 1234
(2, 'lucia',  '$2y$10$HwfP3EvCdqy9RZ.X9Hvy1.eVAZ4/7jOlqaUQL1yiWyPvDW4MFuMI.',  'usuario'), -- 1234
(3, 'martin', '$2y$10$HwfP3EvCdqy9RZ.X9Hvy1.eVAZ4/7jOlqaUQL1yiWyPvDW4MFuMI.', 'usuario'),  -- 1234
(4, 'sofia',  '$2y$10$HwfP3EvCdqy9RZ.X9Hvy1.eVAZ4/7jOlqaUQL1yiWyPvDW4MFuMI.',  'usuario'); -- 1234

-- PERFIL_USUARIO (1:1 con USUARIOS)
INSERT INTO PERFIL_USUARIO (id_usuario, nickname, saldo) VALUES
(1, 'AnvilAdmin', 0.00),
(2, 'LuciaGamer', 50.00),
(3, 'Martin_92',  25.50),
(4, 'SofiPlays',  10.00);

-- JUEGOS (títulos reales)
INSERT INTO JUEGOS (id_juego, nombre, precio, descripcion, pegi) VALUES
(1, 'The Witcher 3: Wild Hunt', 39.99,
    'RPG de mundo abierto en el que encarnas a Geralt de Rivia, un cazador de monstruos en busca de su hija adoptiva.', 18),
(2, 'Hollow Knight', 14.99,
    'Metroidvania de acción y aventura en 2D ambientado en el vasto reino subterráneo de Hallownest.', 7),
(3, 'Stardew Valley', 13.99,
    'Simulador de granja y vida rural: cultiva, pesca, explora minas y haz amistad con los vecinos del pueblo.', 7),
(4, 'Portal 2', 9.99,
    'Juego de puzles en primera persona con portales, cooperativo y de un jugador, ambientado en los laboratorios de Aperture Science.', 12);

-- USUARIOS_JUEGOS (bibliotecas)
INSERT INTO USUARIOS_JUEGOS (id_usuario, id_juego) VALUES
(1, 1),  -- admin   -> The Witcher 3
(1, 4),  -- admin   -> Portal 2
(2, 1),  -- lucia   -> The Witcher 3
(2, 2),  -- lucia   -> Hollow Knight
(2, 3),  -- lucia   -> Stardew Valley
(3, 2),  -- martin  -> Hollow Knight
(3, 4),  -- martin  -> Portal 2
(4, 3);  -- sofia   -> Stardew Valley