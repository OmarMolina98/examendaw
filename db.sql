SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS  EstadoActual;
DROP TABLE IF EXISTS  Registro;
DROP TABLE IF EXISTS  Nombre;

CREATE TABLE `Nombre`
(
	`id`        int(11) not null AUTO_INCREMENT,
	`nombre`    varchar(40),
    PRIMARY KEY (`id`)
);

CREATE TABLE `EstadoActual`
(
	`id`        int(11) not null AUTO_INCREMENT,
	`nombre`    varchar(40),
    PRIMARY KEY (`id`)
);

CREATE TABLE `Registro`
(
	`idNombre`         int(11)         not null,
    `idEstadoActual`   int(11)         not null,
    `fecha`             TIMESTAMP       not null DEFAULT NOW(),

    PRIMARY KEY (`idNombre`,`idEstadoActual`,`fecha`),
    FOREIGN KEY (`idNombre`)     REFERENCES `Nombre`(`id`),
    FOREIGN KEY (`idEstadoActual`) REFERENCES `EstadoActual`(`id`)
);

SET FOREIGN_KEY_CHECKS=1;

INSERT INTO `Nombre` (`nombre`)
VALUE
('Omar'),
('Luis'),
('Ramon'),
('Pancho'),
('Terri');


INSERT INTO `EstadoActual` (`nombre`)
VALUE
('infeccion'),
('desorientación'),
('violencia'),
('desmayo'),
('transformación');

INSERT INTO `Registro` (`idNombre`,`idEstadoActual`)
VALUE
(1,1),
(1,2),
(1,4),
(2,1),
(4,1);
















