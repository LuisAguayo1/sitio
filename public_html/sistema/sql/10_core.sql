
CREATE TABLE IF NOT EXISTS perfil(
	id_perfil BIGINT PRIMARY KEY AUTO_INCREMENT,
	nombre_perfil VARCHAR(100),
	fecha_perfil TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	estatus_perfil SMALLINT DEFAULT 1
);

INSERT INTO perfil VALUES (NULL,'ADMINISTRADOR',now(),1);
INSERT INTO perfil VALUES (NULL,'OPERADOR',now(),1);

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario BIGINT PRIMARY KEY AUTO_INCREMENT,
	acceso_usuario VARCHAR(50) NOT NULL,
	pass_usuario VARCHAR(255) NOT NULL,
	id_perfil BIGINT,
	id_sesion VARCHAR(255) NOT NULL,
	email_usuario VARCHAR(100),
	creacion_usuario TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	fecha_usuario TIMESTAMP,
	estatus_usuario SMALLINT DEFAULT 1,
	INDEX(id_perfil),
	FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil)
);

INSERT INTO usuario VALUES (NULL,'admin',MD5('admin'),1,MD5(now()),'contacto@boonkaa.com',now(),now(),1);

CREATE TABLE IF NOT EXISTS modulo(
	id_modulo INT PRIMARY KEY,
	id_padre INT DEFAULT 0,
	nombre_modulo VARCHAR(100) NOT NULL,
	estatus_modulo SMALLINT DEFAULT 1,
	INDEX(id_padre)
);

INSERT INTO modulo VALUES (10,0,'SISTEMA',1);
INSERT INTO modulo VALUES (11,10,'USUARIOS',1);
INSERT INTO modulo VALUES (12,10,'PERFILES',1);

CREATE TABLE IF NOT EXISTS permiso(
	id_permiso BIGINT PRIMARY KEY AUTO_INCREMENT,
	id_perfil BIGINT,
	id_modulo INT,
	tipo_permiso SMALLINT DEFAULT 1,
	INDEX(id_perfil),
	INDEX(id_modulo),
	FOREIGN KEY (id_perfil) REFERENCES perfil(id_perfil),
	FOREIGN KEY (id_modulo) REFERENCES modulo(id_modulo)
);

INSERT INTO permiso VALUES (NULL,1,10,1);
INSERT INTO permiso VALUES (NULL,1,11,1);
INSERT INTO permiso VALUES (NULL,1,12,1);

