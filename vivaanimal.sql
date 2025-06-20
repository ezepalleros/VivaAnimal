CREATE DATABASE IF NOT EXISTS vivaanimal;
USE vivaanimal;

CREATE TABLE usuario (
    id_usu INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    rol ENUM('cliente', 'empleado', 'admin') NOT NULL
);

CREATE TABLE animal (
    id_ani INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    edad INT,
    especie VARCHAR(50),
    raza VARCHAR(100),
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usu)
);

CREATE TABLE empleado (
    id_emp INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    especialidad VARCHAR(100),
    contratacion DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usu)
);

CREATE TABLE consulta (
    id_con INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    descripcion TEXT NOT NULL,
    id_animal INT NOT NULL,
    id_empleado INT NOT NULL,
    estado BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_animal) REFERENCES animal(id_ani),
    FOREIGN KEY (id_empleado) REFERENCES empleado(id_emp)
);

INSERT INTO usuario (id_usu, nombre, email, telefono, direccion, rol) VALUES
(1001, 'Gabriela Pasos', 'gabriela@gmail.com', '1145899762', 'Cuenca 2453', 'cliente'),
(1002, 'Ana Marciano', 'ana@gmail.com', '1189663232', 'Arregui 1552', 'cliente'),
(1003, 'Carlos Pantera', 'carlos@gmail.com', '1145218734', 'Campana 3221', 'empleado'),
(1004, 'Laura Admin', 'admin@gmail.com', '1198225901', 'Marcos Sastre 2119', 'admin'),
(1005, 'Marcos Plazos', 'marcos@gmail.com', '1133224455', 'Urquiza 1100', 'empleado'),
(1006, 'Sofía Romero', 'sofia@gmail.com', '1199887766', 'Dorrego 2211', 'empleado');

INSERT INTO empleado (id_emp, id_usuario, especialidad, contratacion) VALUES
(4001, 1003, 'Veterinario clínico', '2024-05-10'),
(4002, 1005, 'Traumatología animal', '2024-10-10'),
(4003, 1006, 'Diagnóstico por imagen', '2024-06-11');

INSERT INTO animal (id_ani, nombre, edad, especie, raza, id_usuario) VALUES
(10001, 'Prensa', 5, 'Perro', 'Labrador', 1001),
(10002, 'Platon', 3, 'Gato', 'Siames', 1001),
(10003, 'Juanero', 2, 'Perro', 'Dóberman', 1002),
(10004, 'Palta', 4, 'Gato', 'Persa', 1002);

INSERT INTO consulta (id_con, fecha, descripcion, id_animal, id_empleado, estado) VALUES
(101, '2024-06-10', 'Vacunación antirrábica', 10001, 4001, TRUE),
(102, '2024-07-05', 'Control general', 10002, 4002, TRUE),
(103, '2024-07-12', 'Dolor en pata trasera', 10003, 4002, TRUE),
(104, '2024-08-01', 'Ecografía abdominal', 10004, 4003, TRUE);
