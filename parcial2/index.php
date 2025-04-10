<?php  
session_start();
include("conexion.php");

$sql = "SELECT tareas.id_tarea, 
               tareas.titulo_tarea, 
               tareas.fecha_inicio, 
               tareas.fecha_vencimiento, 
               categorias.nombre_categoria, 
               prioridades.nivel_prioridad, 
               tareas.tarea_completada, 
               tareas.descripcion_tarea 
        FROM tareas 
        JOIN categorias ON tareas.id_categoria = categorias.id_categoria
        JOIN prioridades ON tareas.id_prioridad = prioridades.id_prioridad";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Administrar Tareas</title>
    <style>
        body {
            background-image: url('img/Fondo1.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .titulo {
            width: 300px;
            margin: auto;
            padding: 2px;
            border: 2px solid #333;
            background-color: white;
        }
        h1 {
            padding: 0px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="topnav">
        <a href="calendario.php">Inicio</a>
        <a href="index.php">Administrar tareas</a>
        <a href="ayuda.php">Ayuda</a>
        <a href="documentacion.php">Documentación</a>
    </div>
    <div class="titulo">
        <h1>Lista de Tareas</h1>
    </div>

    <?php if (isset($_SESSION['mensaje'])) : ?>
        <div class="notification"><?= $_SESSION['mensaje']; ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <div class="actions">
        <a href="insert.php">Crear Nueva Tarea</a>
    </div>

    <?php if ($result->num_rows > 0) : ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Vencimiento</th>
                <th>Categoría</th>
                <th>Prioridad</th>
                <th>Completada</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <?php
                    $fechaActual = new DateTime();
                    $fechaVencimiento = new DateTime($row['fecha_vencimiento']);
                    $intervalo = $fechaActual->diff($fechaVencimiento)->days;
                    $proximaAVencer = $fechaVencimiento > $fechaActual && $intervalo <= 3;
                ?>
                <tr id="task-<?= $row['id_tarea']; ?>" class="<?= $proximaAVencer ? 'near-deadline' : ''; ?>">
                    <td><?= htmlspecialchars($row['titulo_tarea']); ?></td>
                    <td><?= htmlspecialchars($row['fecha_inicio']); ?></td>
                    <td><?= htmlspecialchars($row['fecha_vencimiento']); ?></td>
                    <td><?= htmlspecialchars($row['nombre_categoria']); ?></td>
                    <td><?= htmlspecialchars($row['nivel_prioridad']); ?></td>
                    <td class="<?= $row['tarea_completada'] ? 'completed' : 'not-completed'; ?>">
                        <?= $row['tarea_completada'] ? 'Sí' : 'No'; ?>
                    </td>
                    <td><?= htmlspecialchars($row['descripcion_tarea']); ?></td>
                    <td class="action-buttons">
                        <a href="update.php?id=<?= $row['id_tarea']; ?>" class="edit-btn">Editar</a>
                        <form action="delete.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id_tarea']; ?>">
                            <button type="submit" class="delete-btn">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No se encontraron tareas.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
