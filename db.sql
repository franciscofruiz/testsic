# create database testsic;
# use testsic;

CREATE TABLE `usuarios` (
 `id` INT(11) NOT NULL AUTO_INCREMENT,
 `email` VARCHAR(255) NOT NULL ,
 `nombre` VARCHAR(255) NOT NULL ,
 `password` VARCHAR(255) NOT NULL ,
 `status` BOOLEAN NOT NULL DEFAULT 1,
 PRIMARY KEY (`id`)
)ENGINE = INNODB;


CREATE TABLE `radicaciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_solicitante`  VARCHAR(255),
  `fecha` DATETIME DEFAULT NOW(),
  `asunto`  VARCHAR(255),
  `texto_solicitud` text,
  `usuario_crea_id` int(11),
  `usuario_edita_id` int(11),
  INDEX(usuario_crea_id),
  CONSTRAINT `radicaciones_usuario_crea_id` FOREIGN KEY(usuario_crea_id) REFERENCES usuarios(id),
PRIMARY KEY (`id`)
)ENGINE = INNODB;


CREATE TABLE `radicacion_logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha_log`  DATETIME default NOW(),
  `accion`  VARCHAR(255),
  `id_radicacion` INT(11),
  `nombre_solicitante`  VARCHAR(255),
  `fecha` DATETIME DEFAULT NOW(),
  `asunto`  VARCHAR(255),
  `texto_solicitud` text,
  `usuario_crea_id` int(11),
  INDEX(id_radicacion),
  PRIMARY KEY (`id`)
)ENGINE = MYISAM;



DELIMITER $$
CREATE TRIGGER ai_radicacion_log AFTER INSERT ON radicaciones
FOR EACH ROW
BEGIN
  INSERT INTO radicacion_logs (fecha_log, accion, id_radicacion, nombre_solicitante, fecha, asunto, texto_solicitud, usuario_crea_id)
  VALUES(NOW(), 'creación',  NEW.id, NEW.nombre_solicitante, NEW.fecha, NEW.asunto, NEW.texto_solicitud, NEW.usuario_crea_id);
END$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER au_radicacion_log AFTER UPDATE ON radicaciones
FOR EACH ROW
BEGIN
  INSERT INTO radicacion_logs (fecha_log, accion, id_radicacion, nombre_solicitante, fecha, asunto, texto_solicitud, usuario_crea_id)
  VALUES(NOW(), 'actualización',  NEW.id, NEW.nombre_solicitante, NEW.fecha, NEW.asunto, NEW.texto_solicitud, NEW.usuario_edita_id);
END$$
DELIMITER ;

