-- CREACION DE LA BASE DE DATOS
CREATE DATABASE tiendaropa;

-- CREACION DE LAS TABLAS
CREATE TABLE marca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_marca VARCHAR(20) NOT NULL
);

CREATE TABLE articulo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca_id INT,
    nombre_articulo VARCHAR(30) NOT NULL,
    precio_articulo INT NOT NULL,
    cantidad_articulo INT,
    FOREIGN KEY (marca_id) REFERENCES marca(id)
);

CREATE TABLE venta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    articulo_id INT,
    cantidad_total INT NOT NULL,
    fecha_venta DATE NOT NULL,
    FOREIGN KEY (articulo_id) REFERENCES articulo(id)
);

-- INSERCION DE DATOS
INSERT INTO marca (id, nombre_marca) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Umbro'),
(4, 'Under Armour'),
(5, 'Levis'),
(6, 'Everlane');

INSERT INTO articulo (id, nombre_articulo, marca_id, precio_articulo, cantidad_articulo) VALUES
(1, 'Camiseta Polo', 4, 18000, 5),
(2, 'Jeans 501', 5, 27000, 22),
(3, 'Top Corto Acanalado', 1, 15000, 7),
(4, 'Chaqueta Gris A1', 6, 45000, 12),
(5, 'Tacos Mercurial', 1, 85000, 1),
(6, 'Tenis Ultrafly', 1, 130000, 5),
(7, 'Tenis Ultraboost 22 BLK', 2, 45000, 25);

INSERT INTO venta (id, articulo_id, cantidad_total, fecha_venta) VALUES
(1, 1, 3, '2024-05-01'),
(2, 2, 2, '2024-04-21'),
(3, 3, 7, '2024-04-22'),
(4, 4, 2, '2023-05-02'),
(5, 5, 2, '2023-04-24'),
(6, 1, 5, '2023-04-24'),
(7, 1, 3, '2023-04-24'),
(8, 3, 1, '2023-04-24');

-- BORRAR ALGUUN DATO
DELETE FROM venta WHERE articulo_id = 3;
DELETE FROM articulo WHERE id = 3;

-- ACTUALIZAR REGISTRO
UPDATE articulo SET cantidad_articulo = 10 WHERE id = 1;

-- CANT VENDIDA FECHA CONSULTA
SELECT articulo_id, SUM(cantidad_total) AS consulta_venta
FROM venta
WHERE fecha_venta = '2023-04-24'
GROUP BY articulo_id;

-- VISTAS
-- MARCAS CON 1 VENTA MINIMO
CREATE VIEW marcas_ventas AS
SELECT DISTINCT m.id, m.nombre_marca
FROM marca m
JOIN articulo a ON m.id = a.marca_id
JOIN venta v ON a.id = v.articulo_id;

-- PRENDAS VENDIDAS Y CANT DISPON
CREATE VIEW ventas_cantRestante AS
SELECT a.id, a.nombre_articulo, SUM(v.cantidad_total) AS cantidad_vendida, a.cantidad_articulo
FROM articulo a
JOIN venta v ON a.id = v.articulo_id
GROUP BY a.id, a.nombre_articulo, a.cantidad_articulo;

-- 5 MARCAS MAS VENTIDAS, CANT VENTAS
CREATE VIEW top_ventas AS
SELECT m.id, m.nombre_marca, COUNT(v.id) AS cantidad_ventas
FROM marca m
JOIN articulo a ON m.id = a.marca_id
JOIN venta v ON a.id = v.articulo_id
GROUP BY m.id, m.nombre_marca
ORDER BY cantidad_ventas DESC
LIMIT 5;