INSERT INTO positions (id, description, max_vote, priority) VALUES
(1, 'Director de la FI', 1, 1),
(2, 'Consejero', 1, 1),
(3, 'Subdirector', 1, 1);


INSERT INTO candidates (id, position_id, firstname, lastname, photo, platform) VALUES
(1, 1, 'Juan', 'Pérez', 'juan_perez.jpg', 'Plataforma para desarrollo académico.'),
(2, 1, 'María', 'García', 'maria_garcia.jpg', 'Plataforma para mejora en infraestructura académica.'),
(3, 2, 'Carlos', 'López', 'carlos_lopez.jpg', 'Plataforma de inclusión estudiantil.'),
(4, 2, 'Ana', 'Martínez', 'ana_martinez.jpg', 'Plataforma para optimización de recursos.'),
(5, 3, 'Luis', 'Gómez', 'luis_gomez.jpg', 'Fortalecimiento de la investigación.'),
(6, 3, 'Sofía', 'Ramírez', 'sofia_ramirez.jpg', 'Eficiencia en la gestión administrativa.');




INSERT INTO voters (id, voters_id, password, firstname, lastname, email) VALUES
(1, '2021011', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Pedro', 'Sánchez', 'pedro.sanchez@alumno.uaemex.mx.com'),
(2, '2021012', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Lucía', 'Gómez', 'lucia.gomez@alumno.uaemex.mx.com'),
(3, '2021013', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Andrés', 'Martín', 'andres.martin@alumno.uaemex.mx.com'),
(4, '2021014', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Carla', 'Hernández', 'carla.hernandez@alumno.uaemex.mx.com');



-- Inserción de los votos
INSERT INTO votes (id, voters_id, candidate_id, position_id) VALUES
(1, 2021011, 4, 1),
(2, 2021012, 1, 3),
(3, 2021013, 5, 2),
(4, 2021014, 2, 1),
(5, 2021015, 6, 3),
(6, 2021016, 3, 2),
(7, 2021017, 4, 1),
(8, 2021018, 1, 3),
(9, 2021019, 2, 2),
(10, 2021020, 6, 1),
(11, 2021021, 5, 3),
(12, 2021022, 3, 2),
(13, 2021023, 4, 1),
(14, 2021024, 1, 3),
(15, 2021025, 6, 2),
(16, 2021026, 2, 1),
(17, 2021027, 5, 3),
(18, 2021028, 3, 2),
(19, 2021029, 4, 1),
(20, 2021030, 1, 3),
(21, 2021031, 6, 2),
(22, 2021032, 2, 1),
(23, 2021033, 5, 3),
(24, 2021034, 3, 2),
(25, 2021035, 4, 1),
(26, 2021036, 1, 3),
(27, 2021037, 6, 2),
(28, 2021038, 2, 1),
(29, 2021039, 5, 3),
(30, 2021040, 3, 2),
(31, 2021041, 4, 1),
(32, 2021042, 1, 3),
(33, 2021043, 6, 2),
(34, 2021044, 2, 1),
(35, 2021045, 5, 3),
(36, 2021046, 3, 2),
(37, 2021047, 4, 1),
(38, 2021048, 1, 3),
(39, 2021049, 6, 2),
(40, 2021050, 2, 1),
(41, 2021051, 5, 3),
(42, 2021052, 3, 2),
(43, 2021053, 4, 1),
(44, 2021054, 1, 3),
(45, 2021055, 6, 2),
(46, 2021056, 2, 1),
(47, 2021057, 5, 3),
(48, 2021058, 3, 2),
(49, 2021059, 4, 1),
(50, 2021060, 1, 3);



-- Inserción de administrador
INSERT INTO admin (id, username, password, firstname, lastname, photo, created_on) VALUES
(2, 'admin2', '$2y$10$efgh5678efgh5678efgh5678efgh5678efgh5678efgh5678efgh56', 'Admin', 'Two', 'admin2.jpg', '2024-01-01');

CREATE VIEW votaciones_reporte AS
SELECT 
    p.description AS posicion, -- Posición del candidato
    c.firstname AS nombre_candidato, -- Nombre del candidato
    c.lastname AS apellido_candidato, -- Apellido del candidato
    COUNT(v.id) AS votos_recibidos, -- Total de votos recibidos por el candidato
    (SELECT COUNT(v1.id) 
     FROM votes v1 
     WHERE v1.position_id = p.id) AS total_votos_posicion -- Total de votos por posición
FROM 
    candidates c
JOIN 
    positions p ON c.position_id = p.id
LEFT JOIN 
    votes v ON c.id = v.candidate_id
GROUP BY 
    p.description, c.firstname, c.lastname, c.id;


CREATE TABLE registro_reportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    token VARCHAR(255) NOT NULL
);
