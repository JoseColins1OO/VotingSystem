INSERT INTO positions (id, description, max_vote, priority) VALUES
(1, 'Presidente', 1, 1),
(2, 'Vicepresidente', 1, 2),
(3, 'Tesorero', 1, 3),
(4, 'Secretario', 1, 4);




INSERT INTO candidates (id, position_id, firstname, lastname, photo, platform) VALUES
(1, 1, 'Juan', 'Pérez', 'juan_perez.jpg', 'Plataforma para desarrollo económico.'),
(2, 1, 'María', 'García', 'maria_garcia.jpg', 'Plataforma para mejora educativa.'),
(3, 2, 'Carlos', 'López', 'carlos_lopez.jpg', 'Plataforma de inclusión social.'),
(4, 2, 'Ana', 'Martínez', 'ana_martinez.jpg', 'Plataforma de salud pública.'),
(5, 3, 'Luis', 'Gómez', 'luis_gomez.jpg', 'Transparencia en las finanzas.'),
(6, 4, 'Sofía', 'Ramírez', 'sofia_ramirez.jpg', 'Eficiencia administrativa.');




INSERT INTO voters (id, voters_id, password, firstname, lastname, email) VALUES
(1, 'VOT001', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Pedro', 'Sánchez', 'pedro.sanchez@example.com'),
(2, 'VOT002', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Lucía', 'Gómez', 'lucia.gomez@example.com'),
(3, 'VOT003', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Andrés', 'Martín', 'andres.martin@example.com'),
(4, 'VOT004', '$2y$10$abcd1234abcd1234abcd1234abcd1234abcd1234abcd1234abcd12', 'Carla', 'Hernández', 'carla.hernandez@example.com');



INSERT INTO votes (id, voters_id, candidate_id, position_id) VALUES
(1, 1, 1, 1), -- Pedro vota por Juan Pérez (Presidente)
(2, 2, 2, 1), -- Lucía vota por María García (Presidente)
(3, 3, 3, 2), -- Andrés vota por Carlos López (Vicepresidente)
(4, 4, 4, 2), -- Carla vota por Ana Martínez (Vicepresidente)
(5, 1, 5, 3), -- Pedro vota por Luis Gómez (Tesorero)
(6, 2, 6, 4); -- Lucía vota por Sofía Ramírez (Secretario)



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
