CREATE TABLE IF NOT EXISTS articulos (
codigo INT(3) PRIMARY KEY,
articulo VARCHAR(50) NOT NULL
)

CREATE TABLE IF NOT EXISTS instalaciones(
clave_instalacion VARCHAR(3) PRIMARY KEY,
instalacion VARCHAR(30) NOT NULL
)

CREATE TABLE IF NOT EXISTS inventario(
    clave_instalacion VARCHAR(3),
    codigo_articulo INT(3),
    cantidad INT(3) NOT NULL,
    fecha_compra DATE,
    observaciones VARCHAR(250),
    CONSTRAINT pk_inventario PRIMARY KEY(clave_instalacion, codigo_articulo),
    CONSTRAINT fk_InvIns FOREIGN KEY (clave_instalacion) REFERENCES instalaciones(clave_instalacion),
    CONSTRAINT fk_InvArt FOREIGN KEY (codigo_articulo) REFERENCES articulos(codigo)
)

--Añadir campo articulo a tabla inventario
ALTER TABLE inventario ADD articulo varchar(50) AFTER codigo_articulo