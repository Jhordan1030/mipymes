create database academico;
GRANT ALL PRIVILEGES ON academico.* TO 'jmhueran'@'localhost' IDENTIFIED BY 'jmhueran';
create table notas(
	cedula varchar(10) primary key,
	nombres varchar(50) not null,
	nota1 float not null,
	nota2 float not null,
	promedio float as((nota1 + nota2)/2) stored
);
insert into notas(cedula,nombres,nota1,nota2)values('1005487659','ANDRADE LUIS',7,8);
insert into notas(cedula,nombres,nota1,nota2)values('0401234567','RUIZ ANA',9,9);
insert into notas(cedula,nombres,nota1,nota2)values('0404578452','ZAPATA JORGE',7,7);
