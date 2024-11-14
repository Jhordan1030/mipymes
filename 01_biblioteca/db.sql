create database biblioteca;
GRANT ALL PRIVILEGES ON biblioteca.* TO 'jmhueran'@'localhost' IDENTIFIED BY 'jmhueran';
create table libro(
	lib_codigo int primary key,
	lib_titulo varchar(50) not null,
	lib_año int not null,
	lib_autor varchar(50) not null,
	lib_paginas int not null
);
insert into libro(lib_codigo,lib_titulo,lib_año,lib_autor,lib_paginas)values(1005,'Programando con PHP – básico.',2010,'John Carter',310);
insert into libro(lib_codigo,lib_titulo,lib_año,lib_autor,lib_paginas)values(0401,'Desarrolle aplicaciones MVC en 15 días.',2013,'Hannibal Lecte',250);
insert into libro(lib_codigo,lib_titulo,lib_año,lib_autor,lib_paginas)values(0404,'PHP for dummies.',2011,'Stephen King',18);
