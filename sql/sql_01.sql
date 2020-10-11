CREATE DATABASE dev;

CREATE TABLE dev.developers(
	id_developers INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(255) NOT NULL,
	sexo char(1) NOT NULL,
	idade int(3) NOT NULL,
	hobby VARCHAR(255) NOT NULL,
    datanascimento date NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

insert into dev.developers (nome, sexo, idade, hobby, datanascimento) values ('Alessandro Ribeiro Frias', 'M', 23, 'Gamer','1996-12-17');
insert into dev.developers (nome, sexo, idade, hobby, datanascimento) values ('Francisco da Silva', 'M', 25, 'Pescador','1990-01-10');

select * from dev.developers;
use dev;
SHOW TABLES;