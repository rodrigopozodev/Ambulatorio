-- Insertar pacientes
INSERT INTO paciente (nombre, informacion_medica) VALUES
    ('Laura Gómez', 'Historial médico: Problemas cardíacos'),
    ('Carlos Pérez', 'Historial médico: Alergia a la piel'),
    ('Sofía García', 'Historial médico: Migrañas frecuentes'),
    ('Pedro Rodríguez', 'Historial médico: Vacunación infantil');

-- Insertar médicos
INSERT INTO medico (nombre, especialidad) VALUES
    ('Dr. Martínez', 'Cardiología'),
    ('Dra. Sánchez', 'Dermatología'),
    ('Dr. Pérez', 'Neurología'),
    ('Dra. Rodríguez', 'Pediatría');

-- Insertar citas
INSERT INTO cita (id_paciente, id_medico, fecha) VALUES
    (1, 1, '2023-12-01 10:00:00'),
    (2, 2, '2023-12-02 11:30:00'),
    (3, 3, '2023-12-03 09:45:00'),
    (4, 4, '2023-12-04 15:15:00');

-- Insertar consultas
INSERT INTO consulta (id_cita, sintomatologia, diagnostico, pdf, fecha_registro) VALUES
    (1, 'Dolor en el pecho', 'Necesita más pruebas', 'adjunto.pdf', '2023-12-01 11:30:00'),
    (2, 'Erupción en la piel', 'Alergia leve', NULL, '2023-12-02 13:00:00'),
    (3, 'Dolores de cabeza frecuentes', 'Migrañas', 'informe.pdf', '2023-12-03 11:00:00'),
    (4, 'Vacunación infantil', 'En buen estado de salud', NULL, '2023-12-04 16:00:00');
