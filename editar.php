<?php
include("conexion.php");

$id = isset($_GET["id"]) ? $_GET["id"] : die("ID no proporcionado");

$sql = "SELECT * FROM personas WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $sexo = $_POST["sexo"];

    $sql = "UPDATE personas SET nombre=?, fecha_nacimiento=?, sexo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $fecha_nacimiento, $sexo, $id);

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente";
    } else {
        echo "Error al actualizar datos: " . $conn->error;
    }

    $stmt->close();
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Editar Datos</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $row["nombre"]; ?>" required><br>
        Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" value="<?php echo $row["fecha_nacimiento"]; ?>" required><br>
        Sexo: <input type="text" name="sexo" value="<?php echo $row["sexo"]; ?>" required><br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>

