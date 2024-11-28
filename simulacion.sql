INSERT INTO positions (id, description, max_vote, priority) VALUES
(1, 'Director de la FI', 1, 1);


INSERT INTO candidates (id, position_id, firstname, lastname, photo, platform) VALUES
(1, 1, 'Juan', 'Pérez', 'juan_perez.jpg', 'Plataforma para desarrollo académico.'),
(2, 1, 'María', 'García', 'maria_garcia.jpg', 'Plataforma para mejora en infraestructura académica.'),
(3, 1, 'Carlos', 'López', 'carlos_lopez.jpg', 'Plataforma de inclusión estudiantil.'),
(4, 1, 'Ana', 'Martínez', 'ana_martinez.jpg', 'Plataforma para optimización de recursos.'),
(5, 1, 'Luis', 'Gómez', 'luis_gomez.jpg', 'Fortalecimiento de la investigación.'),
(6, 1, 'Sofía', 'Ramírez', 'sofia_ramirez.jpg', 'Eficiencia en la gestión administrativa.');




INSERT INTO voters (id, voters_id, password, firstname, lastname, email) VALUES
(1, '2021011', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Pedro', 'Sánchez', 'pedro.sanchez@alumno.uaemex.mx.com'),
(2, '2021012', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Lucía', 'Gómez', 'lucia.gomez@alumno.uaemex.mx.com'),
(3, '2021013', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Andrés', 'Martín', 'andres.martin@alumno.uaemex.mx.com'),
(4, '2021014', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Carla', 'Hernández', 'carla.hernandez@alumno.uaemex.mx.com');



-- Inserción de los votos
INSERT INTO votes (id, voters_id, candidate_id, position_id) VALUES
(1, 2021011, 1, 1), -- Pedro vota por Juan Pérez (Director de la Facultad de Ingeniería)
(2, 2021012, 2, 1), -- Lucía vota por María García (Director de la Facultad de Ingeniería)
(3, 2021013, 3, 1), -- Andrés vota por Carlos López (Director de la Facultad de Ingeniería)
(4, 2021014, 4, 1), -- Carla vota por Ana Martínez (Director de la Facultad de Ingeniería)
(5, 2021011, 5, 1), -- Pedro vota por Luis Gómez (Director de la Facultad de Ingeniería)
(6, 2021012, 6, 1); -- Lucía vota por Sofía Ramírez (Director de la Facultad de Ingeniería)


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
