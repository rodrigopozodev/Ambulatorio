-- Insertar médicos
INSERT INTO medico (nombre, apellidos, especialidad) VALUES
    ('Dr. Martínez', 'Gómez', 'Cardiología'),
    ('Dra. Sánchez', 'Pérez', 'Dermatología'),
    ('Dr. Pérez', 'García', 'Neurología'),
    ('Dra. Rodríguez', 'Rodríguez', 'Pediatría');

-- Insertar pacientes
INSERT INTO paciente (dni, nombre, apellidos, genero, fecha_nac, id_medicos_asignados) VALUES
    ('123456789', 'Laura', 'Gómez', 'F', '1990-05-15', '1'),
    ('987654321', 'Carlos', 'Pérez', 'M', '1985-08-22', '2'),
    ('456789123', 'Sofía', 'García', 'F', '2000-12-10', '3'),
    ('789123456', 'Pedro', 'Rodríguez', 'M', '1998-02-28', '4');

-- Insertar consultas
INSERT INTO consulta (id_medico, id_paciente, fecha_consulta, diagnostico, sintomatologia) VALUES
    (1, 1, '2023-12-01', 'Pruebas adicionales necesarias', 'Dolor en el pecho'),
    (2, 2, '2023-12-02', 'Alergia leve', 'Erupción en la piel'),
    (3, 3, '2023-12-03', 'Migrañas', 'Dolores de cabeza frecuentes'),
    (4, 4, '2023-12-04', 'En buen estado de salud', 'Vacunación infantil');

-- Insertar medicamentos
INSERT INTO medicamento (nombre) VALUES
    ('Paracetamol'),
    ('Ibuprofeno'),
    ('Amoxicilina'),
    ('Loratadina');

-- Insertar recetas
INSERT INTO receta (id_medicamento, id_consulta, posologia, fecha_fin) VALUES
    (1, 1, 'Tomar cada 8 horas', '2023-12-10'),
    (2, 2, 'Tomar cada 12 horas', '2023-12-15'),
    (3, 3, 'Tomar una vez al día', '2023-12-20'),
    (4, 4, 'Tomar según necesidad', NULL);
