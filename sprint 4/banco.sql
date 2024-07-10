create database convvet;
use convvet;
 
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    endereco VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    animal VARCHAR(50) NOT NULL,
    race VARCHAR(50) NOT NULL,
    animalName VARCHAR(100) NOT NULL
);
 
select * from clientes;

create table clinicas(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(100) NOT NULL,
 clinicName VARCHAR(100) NOT NULL,
 endereco VARCHAR(100) NOT NULL,
 phone VARCHAR(100) NOT NULL,
 commercialEmail VARCHAR(100) NOT NULL,
 cnpj VARCHAR(100) NOT NULL
);
select * from clinicas;
