<?php
include 'config.php';

// Manejar el envío del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    $sql = "INSERT INTO usuarios (nombre, apellido) VALUES ('$nombre', '$apellido')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Paginación
$registros_por_pagina = 5; // Número de registros por página
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Obtener el número total de registros
$sql_total = "SELECT COUNT(*) as total FROM usuarios";
$result_total = $conn->query($sql_total);
$total_registros = $result_total->fetch_assoc()['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Leer usuarios para la página actual
$sql = "SELECT * FROM usuarios LIMIT $offset, $registros_por_pagina";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="/index.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Nuevo Usuario</h2>
        <form method="post" action="">
            Nombre: <input type="text" name="nombre" required><br>
            Apellido: <input type="text" name="apellido" required><br>
            <input type="submit" value="Agregar">
        </form>

        <h2>Lista de Usuarios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["cod"]. "</td>
                            <td>" . $row["nombre"]. "</td>
                            <td>" . $row["apellido"]. "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No hay registros</td></tr>";
            }
            ?>
        </table>

        <!-- Paginación -->
        <div class="pagination">
            <?php
            if ($pagina_actual > 1) {
                echo "<a href='agregar.php?pagina=" . ($pagina_actual - 1) . "'>Anterior</a> ";
            }

            for ($i = 1; $i <= $total_paginas; $i++) {
                if ($i == $pagina_actual) {
                    echo "<strong>$i</strong> ";
                } else {
                    echo "<a href='agregar.php?pagina=$i'>$i</a> ";
                }
            }

            if ($pagina_actual < $total_paginas) {
                echo "<a href='agregar.php?pagina=" . ($pagina_actual + 1) . "'>Siguiente</a>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
