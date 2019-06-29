CREATE TABLE Administrator (
	idAdministrator int(11) NOT NULL AUTO_INCREMENT,
	name varchar(45) NOT NULL,
	lastName varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	password varchar(45) NOT NULL,
	picture varchar(45) DEFAULT NULL,
	phone varchar(45) DEFAULT NULL,
	mobile varchar(45) DEFAULT NULL,
	PRIMARY KEY (idAdministrator)
);

INSERT INTO Administrator (idAdministrator, name, lastName, email, password, phone, mobile) VALUES 
	('1', 'administrator', 'administrator', 'admin@udistrital.edu.co', md5('123'), '123', '123'); 

CREATE TABLE LogAdministrator (
	idLogAdministrator int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	administrator_idAdministrator int(11) NOT NULL,
	PRIMARY KEY (idLogAdministrator)
);

CREATE TABLE LogEvaluador (
	idLogEvaluador int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	evaluador_idEvaluador int(11) NOT NULL,
	PRIMARY KEY (idLogEvaluador)
);

CREATE TABLE Evaluador (
	idEvaluador int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	email varchar(45) DEFAULT NULL,
	password varchar(45) DEFAULT NULL,
	imagen varchar(45) DEFAULT NULL,
	PRIMARY KEY (idEvaluador)
);

CREATE TABLE LogParticipante (
	idLogParticipante int(11) NOT NULL AUTO_INCREMENT,
	accion varchar(45) NOT NULL,
	informacion text NOT NULL,
	fecha date NOT NULL,
	hora time NOT NULL,
	ip varchar(45) NOT NULL,
	so varchar(45) NOT NULL,
	explorador varchar(45) NOT NULL,
	participante_idParticipante int(11) NOT NULL,
	PRIMARY KEY (idLogParticipante)
);

CREATE TABLE Participante (
	idParticipante int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	apellido varchar(45) NOT NULL,
	email varchar(45) DEFAULT NULL,
	password varchar(45) DEFAULT NULL,
	imagen varchar(45) DEFAULT NULL,
	PRIMARY KEY (idParticipante)
);

CREATE TABLE ProgramaAcademico (
	idProgramaAcademico int(11) NOT NULL AUTO_INCREMENT,
	nombre varchar(45) NOT NULL,
	PRIMARY KEY (idProgramaAcademico)
);

CREATE TABLE Esquema (
	idEsquema int(11) NOT NULL AUTO_INCREMENT,
	pregunta_idPregunta int(11) NOT NULL,
	respuesta_idRespuesta int(11) NOT NULL,
	cuestionario_idCuestionario int(11) NOT NULL,
	PRIMARY KEY (idEsquema)
);

CREATE TABLE Value (
	idValue int(11) NOT NULL AUTO_INCREMENT,
	programaAcademico_idProgramaAcademico int(11) NOT NULL,
	respuesta_idRespuesta int(11) NOT NULL,
	PRIMARY KEY (idValue)
);

CREATE TABLE Respuesta (
	idRespuesta int(11) NOT NULL AUTO_INCREMENT,
	tipo varchar(45) NOT NULL,
	valor int NOT NULL,
	PRIMARY KEY (idRespuesta)
);

CREATE TABLE Pregunta (
	idPregunta int(11) NOT NULL AUTO_INCREMENT,
	pregunta varchar(45) NOT NULL,
	PRIMARY KEY (idPregunta)
);

CREATE TABLE Cuestionario (
	idCuestionario int(11) NOT NULL AUTO_INCREMENT,
	respuesta varchar(45) NOT NULL,
	participante_idParticipante int(11) NOT NULL,
	PRIMARY KEY (idCuestionario)
);

ALTER TABLE LogAdministrator
 	ADD FOREIGN KEY (administrator_idAdministrator) REFERENCES Administrator (idAdministrator); 

ALTER TABLE LogEvaluador
 	ADD FOREIGN KEY (evaluador_idEvaluador) REFERENCES Evaluador (idEvaluador); 

ALTER TABLE LogParticipante
 	ADD FOREIGN KEY (participante_idParticipante) REFERENCES Participante (idParticipante); 

ALTER TABLE Esquema
 	ADD FOREIGN KEY (pregunta_idPregunta) REFERENCES Pregunta (idPregunta); 

ALTER TABLE Esquema
 	ADD FOREIGN KEY (respuesta_idRespuesta) REFERENCES Respuesta (idRespuesta); 

ALTER TABLE Esquema
 	ADD FOREIGN KEY (cuestionario_idCuestionario) REFERENCES Cuestionario (idCuestionario); 

ALTER TABLE Value
 	ADD FOREIGN KEY (programaacademico_idProgramaAcademico) REFERENCES ProgramaAcademico (idProgramaAcademico); 

ALTER TABLE Value
 	ADD FOREIGN KEY (respuesta_idRespuesta) REFERENCES Respuesta (idRespuesta); 

ALTER TABLE Cuestionario
 	ADD FOREIGN KEY (participante_idParticipante) REFERENCES Participante (idParticipante); 

