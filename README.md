<!-- Utilizacion de Markdown -->
---

# Estructura de Carpetas

**connections/conexiones:** Contiene el archivo `conecta.php` que se encarga de establecer la conexión con el servidor y la base de datos.

**scripts:** Almacena el archivo `crea_tablas.php`, donde tendrás las funciones para crear las tablas y realizar la inserción de datos.

**classes/clases:** Contiene los archivos `medico.php`, `paciente.php`, y `consulta.php`, donde defines las clases correspondientes.

**data/datos:** Puedes incluir un archivo `datos.sql` que contenga datos de ejemplo o de prueba para las tablas.

**pages/paginas:**
  - **medico:** Contiene archivos relacionados con la página de médico.
    - `main.js`: Script para la lógica de la página.
    - `Index.html`: Estructura HTML de la página.
    - `style.css`: Estilos CSS específicos para la página de médico.
  - **paciente:** Contiene archivos relacionados con la página de paciente.
    - `main.js`: Script para la lógica de la página.
    - `Index.html`: Estructura HTML de la página.
    - `style.css`: Estilos CSS específicos para la página de paciente.
  - **consulta:** Contiene archivos relacionados con la página de consulta.
    - `main.js`: Script para la lógica de la página.
    - `Index.html`: Estructura HTML de la página.
    - `style.css`: Estilos CSS específicos para la página de consulta.

**index.php:** El archivo principal de tu aplicación donde puedes incluir la lógica principal y utilizar las clases y funciones definidas en otras carpetas.

**images:** Puedes almacenar todas las imágenes relacionadas con tu proyecto en esta carpeta.

---

# Archivo `conecta.php`

El archivo `conecta.php` contiene una función esencial para el proyecto: `getConexion()`. Esta función se encarga de establecer la conexión con el servidor de la base de datos. Aquí está una explicación paso a paso:

1. **Parámetros de conexión:**
   - `servidor`: La dirección del servidor de la base de datos "<u>localhost</u>".
   - `usuario`: Tu nombre de usuario de la base de datos "<u>root</u>".
   - `contrasena`: Tu contraseña de la base de datos <u>""</u>.
   - `bd`: El nombre de la base de datos a la que te estás conectando "<u>Ambulatorio</u>" en este caso.

2. **Creación de la conexión:**
   - Se utiliza la clase `mysqli` de PHP para crear una nueva conexión con el servidor de la base de datos.
   - La conexión se establece con los parámetros proporcionados.

3. **Verificación de la conexión:**
   - Se verifica si hay errores durante la conexión utilizando la propiedad `connect_error` de la instancia de conexión.
   - Si se encuentra un error, se finaliza el script y se muestra un mensaje de error.

4. **Retorno de la conexión:**
   - Si la conexión es exitosa, la función devuelve el objeto de conexión, permitiendo su uso en otras partes del proyecto.
```php
<?php

function getConexion() {
    $servidor = "localhost";
    $usuario = "root";
    $contrasena = "";
    $bd = "Ambulatorio";

    $conexion = new mysqli('localhost', 'root', '', 'Ambulatorio');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    return $conexion;
}

?>
```
---

# Archivo `crea_tablas.php`

Este archivo PHP, `crea_tablas.php`, se encarga de definir y crear las tablas necesarias para el sistema de un ambulatorio en una base de datos. A continuación, se ofrece una explicación detallada de cada tabla creada:

Primero:

```php
<?php

// Incluye el archivo de conexión
require_once('../connections/conecta.php');

// Función para crear las tablas
function crearTablas() {
    // Obtiene la conexión a la base de datos
    $conexion = getConexion();
```

A continuacion se crean las tablas

## Tabla `consulta`

La tabla `consulta` registra las interacciones médico-paciente, almacenando información como la fecha de consulta, diagnóstico y síntomas.

- **Campos Principales:**
  - `id_consulta`: Identificador único autonumérico de cada consulta.
  - `id_medico`: Clave foránea que referencia al médico que realizó la consulta.
  - `id_paciente`: Clave foránea que referencia al paciente relacionado con la consulta.
  - `fecha_consulta`: Fecha en que se realizó la consulta.
  - `diagnostico`: Diagnóstico médico de la consulta.
  - `sintomatologia`: Descripción detallada de los síntomas presentados por el paciente.

```sql
CREATE TABLE IF NOT EXISTS consulta (
    id_consulta INT AUTO_INCREMENT PRIMARY KEY,
    id_medico INT,
    id_paciente INT,
    fecha_consulta DATE,
    diagnostico TEXT,
    sintomatologia TEXT,
    FOREIGN KEY (id_medico) REFERENCES medico(id_medico),
    FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente)
);
```
```php
//  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaConsulta);
```

## Tabla `medicamento`

La tabla `medicamento` almacena información sobre los medicamentos disponibles para los pacientes.

- **Campos Principales:**
  - `id_medicamento`: Identificador único autonumérico para cada medicamento.
  - `nombre`: Nombre del medicamento.

```sql
CREATE TABLE IF NOT EXISTS medicamento (
    id_medicamento INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50)
);
```
```php
//  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaMedicamento);
```
## Tabla `receta`

La tabla `receta` registra las recetas médicas asignadas a los pacientes, incluyendo detalles como la posología y la fecha de finalización del tratamiento.

- **Campos Principales:**
  - `id_medicamento`: Clave foránea que referencia al medicamento prescrito en la receta.
  - `id_consulta`: Clave foránea que referencia a la consulta asociada a la receta.
  - `posologia`: Indicaciones sobre la dosis y frecuencia del medicamento.
  - `fecha_fin`: Fecha en que concluye el tratamiento prescrito.

```sql
CREATE TABLE IF NOT EXISTS receta (
    id_medicamento INT,
    id_consulta INT,
    posologia VARCHAR(50),
    fecha_fin DATE,
    FOREIGN KEY (id_medicamento) REFERENCES medicamento(id_medicamento),
    FOREIGN KEY (id_consulta) REFERENCES consulta(id_consulta)
);
```
```php
//  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaReceta);
```

## Tabla `medico`

La tabla `medico` almacena información sobre los médicos del ambulatorio, incluyendo su nombre, apellidos y especialidad.

- **Campos Principales:**
  - `id_medico`: Identificador único autonumérico para cada médico.
  - `nombre`: Nombre del médico.
  - `apellidos`: Apellidos del médico.
  - `especialidad`: Especialidad médica del profesional.

```sql
CREATE TABLE IF NOT EXISTS medico (
    id_medico INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    especialidad VARCHAR(50)
);
```
```php
//  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaMedico);
```

## Tabla `paciente`

La tabla `paciente` contiene detalles sobre los pacientes, como su DNI, nombre, apellidos, género, fecha de nacimiento y médicos asignados.

- **Campos Principales:**
  - `id_paciente`: Identificador único autonumérico para cada paciente.
  - `dni`: Número de identificación único del paciente.
  - `nombre`: Nombre del paciente.
  - `apellidos`: Apellidos del paciente.
  - `genero`: Género del paciente (M = Masculino, F = Femenino, O = Otro).
  - `fecha_nac`: Fecha de nacimiento del paciente.
  - `id_medicos_asignados`: Almacena IDs de médicos asignados como una cadena de texto.

```sql
CREATE TABLE IF NOT EXISTS paciente (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    dni VARCHAR(10),
    nombre VARCHAR(50),
    apellidos VARCHAR(50),
    genero CHAR(1),
    fecha_nac DATE,
    id_medicos_asignados TEXT
);
```
```php
//  ejecuta la consulta SQL para crear la tabla
    $conexion->query($crearTablaPaciente);
```

Por ultimo
```php
 // Cerrar conexión
    $conexion->close();
}

// Llamamos a la función para crear las tablas
crearTablas();
?>
```

---

# Resultado de las Tablas Creadas
## Tablas `Creadas`
![Tablas Creadas](images/Tablas_creadas_Ambulatorio.png)
![Tablas Creadas Extendidas](images/Tablas_extendidas_Ambulatorio.png)

## Campos `Tablas`
![Campos_Consulta](images/Campos_Consulta_Ambulatorio.png)
![Campos_Medicamentos](images/Campos_Medicamentos_Ambulatorio.png)
![Campos_Medico](images/Campos_Medico_Ambulatorio.png)
![Campos_Paciente](images/Campos_Paciente_Ambulatorio.png)
![Campos_Receta](images/Campos_Receta_Ambulatorio.png)

