-- Cabritas de Alponso: catálogo ficticio para el parcial II de Programación Web II .


CREATE DATABASE IF NOT EXISTS cabritas_de_alponso
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE cabritas_de_alponso;
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS cabras (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    raza VARCHAR(100) NOT NULL,
    edad_meses TINYINT UNSIGNED NOT NULL,
    precio DECIMAL(10,2) UNSIGNED NOT NULL,
    uso_principal VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    disponible BOOLEAN NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cabras
    (nombre, raza, edad_meses, precio, uso_principal, descripcion, imagen, disponible)
VALUES
    ('Margarita', 'Saanen', 4, 185000, 'Leche', 'Pelaje blanco y temperamento tranquilo.', 'assets/img/cabras/margarita.jpg', 1),
    ('Alponso', 'Enana nigeriana', 5, 210000, 'Compañía', 'Cabrito pequeño, curioso y sociable.', 'assets/img/cabras/alponso.jpg', 1),
    ('Luna', 'Alpina', 4, 175000, 'Leche', 'Cabrita activa de pelaje marrón con marcas oscuras.', 'assets/img/cabras/luna.jpg', 1),
    ('Copo', 'Angora', 6, 195000, 'Fibra', 'Cabrito de pelaje claro y rizado.', 'assets/img/cabras/copo.jpg', 1),
    ('Canela', 'Anglo Nubian', 5, 190000, 'Leche', 'Cabrita de orejas largas y pelaje canela.', 'assets/img/cabras/canela.jpg', 1),
    ('Rebecco', 'Criolla', 6, 130000, 'Pastoreo', 'Cabrito curioso, acostumbrado a recorrer el potrero.', 'assets/img/cabras/rebecco.jpg', 1),
    ('Nube', 'Saanen', 5, 180000, 'Leche', 'Cabrita blanca, tranquila y sociable.', 'assets/img/cabras/nube.jpg', 1),
    ('Mora', 'Alpina', 6, 178000, 'Crianza', 'Cabrita de pelaje oscuro y carácter atento.', 'assets/img/cabras/mora.jpg', 1),
    ('Pancho', 'Boer', 5, 205000, 'Carne', 'Cabrito de cuerpo blanco y cabeza marrón.', 'assets/img/cabras/pancho.jpg', 1),
    ('Rosita', 'Enana nigeriana', 4, 215000, 'Compañía', 'Cabrita pequeña de pelaje moteado.', 'assets/img/cabras/rosita.jpg', 1),
    ('Chispa', 'Criolla', 5, 125000, 'Pastoreo', 'Cabrita ágil y exploradora.', 'assets/img/cabras/chispa.jpg', 1),
    ('Rolo', 'Angora', 6, 198000, 'Fibra', 'Cabrito de pelaje abundante y rizado.', 'assets/img/cabras/rolo.jpg', 0),
    ('Olivia', 'Anglo Nubian', 6, 192000, 'Leche', 'Cabrita de orejas largas y pelaje marrón.', 'assets/img/cabras/olivia.jpg', 1),
    ('Mantequita', 'Criolla', 4, 128000, 'Crianza', 'Cabrita de pelaje blanco con manchas negras.', 'assets/img/cabras/mantequita.jpg', 1),
    ('Simón', 'Boer', 6, 208000, 'Carne', 'Cabrito tranquilo de cabeza rojiza.', 'assets/img/cabras/simon.jpg', 1),
    ('Perlita', 'Saanen', 4, 183000, 'Leche', 'Cabrita de pelaje blanco y comportamiento dócil.', 'assets/img/cabras/perlita.jpg', 0),
    ('Avellana', 'Alpina', 5, 177000, 'Leche', 'Cabrita de pelaje castaño y patas oscuras.', 'assets/img/cabras/avellana.jpg', 1),
    ('Pipo', 'Enana nigeriana', 5, 212000, 'Compañía', 'Cabrito pequeño y sociable de pelaje tricolor.', 'assets/img/cabras/pipo.jpg', 1);
