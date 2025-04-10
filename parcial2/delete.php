<?php 
session_start();
include("conexion.php");

// Verificar que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID de la tarea desde el formulario
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    // Verificar que se haya proporcionado un ID válido
    if ($id > 0) {
        // Preparar la consulta SQL para eliminar la tarea
        $stmt = $conn->prepare("DELETE FROM tareas WHERE id_tarea = ?");
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta y verificar si se eliminó correctamente
        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Tarea eliminada exitosamente.";
        } else {
            $_SESSION['mensaje'] = "Error al eliminar la tarea: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Mensaje de error si el ID no es válido
        $_SESSION['mensaje'] = "ID de tarea no válido.";
    }

    // Redirigir de nuevo a la página principal después de eliminar
    header("Location: index.php");
    exit();
} else {
    // Mensaje de error si el método no es POST
    $_SESSION['mensaje'] = "Método de solicitud no permitido.";
    header("Location: index.php");
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
