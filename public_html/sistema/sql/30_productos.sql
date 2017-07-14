CREATE TABLE IF NOT EXISTS categoria(
	id_categoria BIGINT PRIMARY KEY AUTO_INCREMENT,
	id_padre BIGINT DEFAULT 0,
	nombre_categoria VARCHAR(100) NOT NULL,
	descripcion_categoria TEXT,
	fecha_categoria TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	estatus_categoria SMALLINT DEFAULT 1
);

CREATE TABLE IF NOT EXISTS producto(
	id_producto BIGINT PRIMARY KEY AUTO_INCREMENT,
	id_categoria BIGINT NOT NULL,
	nombre_producto VARCHAR(255),
	clave_producto VARCHAR(100),
	descripcion_producto TEXT,
	precio_producto FLOAT DEFAULT 0,
	existencia_producto INT DEFAULT 0,
	visitas_producto BIGINT DEFAULT 0,
	fecha_producto TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	estatus_producto SMALLINT DEFAULT 1,
	INDEX(id_categoria),
	FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria)
);

CREATE TABLE IF NOT EXISTS producto_imagen(
	id_imagen BIGINT PRIMARY KEY AUTO_INCREMENT,
	id_producto BIGINT NOT NULL,
	ruta_imagen VARCHAR(255) NOT NULL,
	descripcion_imagen VARCHAR(255),
	fecha_imagen TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	estatus_imagen SMALLINT DEFAULT 1,
	INDEX(id_producto),
	FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

INSERT INTO modulo VALUES (30,0,'CATALOGO',1);
INSERT INTO modulo VALUES (31,30,'CATEGORIAS',1);
INSERT INTO modulo VALUES (32,30,'PRODUCTOS',1);

INSERT INTO permiso VALUES (NULL,1,30,1);
INSERT INTO permiso VALUES (NULL,1,31,1);
INSERT INTO permiso VALUES (NULL,1,32,1);

