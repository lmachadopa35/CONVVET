create database convvet;
use convvet;
 
CREATE TABLE agendamento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motivo VARCHAR(200) NOT NULL,
    hora VARCHAR(5) NOT NULL,
    adata VARCHAR(10) NOT NULL,
    clinica VARCHAR(100) NOT NULL
);

CREATE TABLE emergencia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motivo VARCHAR(200) NOT NULL,
    elocal VARCHAR(5) NOT NULL,
    clinica VARCHAR(100) NOT NULL
);
select * from agendamento;
select * from emergencia;