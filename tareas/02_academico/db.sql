create database academico;
GRANT ALL PRIVILEGES ON academico.* TO 'jmhueran'@'localhost' IDENTIFIED BY 'jmhueran';
create table notas(
	cedula varchar(50) primary key,
	nombre varchar(50) not null,
	nota1 int not null,
	nota2 varchar(50) not null,
	 promedio FLOAT AS ((nota1 + nota2) / 2) STORED
);
-- Insertar datos en la tabla notas
INSERT INTO notas (cedula, nombres, nota1, nota2) VALUES ('1005487659', 'ANDRADE LUIS', 7, 8);
INSERT INTO notas (cedula, nombres, nota1, nota2) VALUES ('0401234567', 'RUIZ ANA', 9, 9);
INSERT INTO notas (cedula, nombres, nota1, nota2) VALUES ('0404578452', 'ZAPATA JORGE', 7, 7);

