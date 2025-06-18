CREATE DATABASE vivaanimal;
USE vivaanimal;

CREATE TABLE clientes (
    id_cli INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    rol VARCHAR(255)
);

CREATE TABLE animales (
    id_ani INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    edad INT,
    especie VARCHAR(50),
    raza VARCHAR(100),
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cli)
);

CREATE TABLE empleados (
    id_emp INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    especialidad VARCHAR(100),
    contratacion DATE,
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cli)
);


CREATE TABLE consultas (
    id_con INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    descripcion TEXT,
    id_animal INT,
    id_empleado INT,
    FOREIGN KEY (id_animal) REFERENCES animales(id_ani),
    FOREIGN KEY (id_empleado) REFERENCES empleados(id_emp)
);

INSERT INTO clientes (id_cli, nombre, email, telefono, direccion, rol) VALUES
(1001, 'Gabriela Pasos', 'gabriela@mail.com', '1145899762', 'Cuenca 2453', 'cliente'),
(1002, 'Ana Marciano', 'ana@gmail.com', '1189663232', 'Arregui 1552', 'cliente'),
(1003, 'Carlos Pantera', 'carlos@gmail.com', '1145218734', 'Campana 3221', 'empleado'),
(1004, 'Laura Admin', 'admin@gmail.com', '1198225901', 'Marcos Sastre 2119', 'admin'),
(1005, 'Marcos Plazos', 'marcos@gmail.com', '1133224455', 'Urquiza 1100', 'empleado'),
(1006, 'Sofía Romero', 'sofia@gmail.com', '1199887766', 'Dorrego 2211', 'empleado');

INSERT INTO empleados (id_emp, nombre, especialidad, contratacion, id_cliente) VALUES
(2001, 'Carlos Pantera', 'Veterinario clínico', '2024-05-10', 1003),
(2002, 'Marcos Plazos', 'Traumatología animal', '2024-10-10', 1005),
(2003, 'Sofía Romero', 'Diagnóstico por imagen', '2024-06-11', 1006);

INSERT INTO animales (id_ani, nombre, edad, especie, raza, id_cliente) VALUES
(10001, 'Prensa', 5, 'Perro', 'Labrador', 1001),
(10002, 'Platon', 3, 'Gato', 'Siames', 1001),
(10003, 'Juanero', 2, 'Perro', 'Dóberman', 1002),
(10004, 'Palta', 4, 'Gato', 'Persa', 1002);

INSERT INTO consultas (id_con, fecha, descripcion, id_animal, id_empleado) VALUES
(101, '2024-06-10', 'Vacunación antirrábica', 10001, 2001),
(102, '2024-07-05', 'Control general', 10002, 2002),
(103, '2024-07-12', 'Dolor en pata trasera', 10003, 2002),
(104, '2024-08-01', 'Ecografía abdominal', 10004, 2003);