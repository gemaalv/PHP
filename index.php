<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $sexo = $_POST["sexo"];

    $sql = "INSERT INTO personas (nombre, fecha_nacimiento, sexo) VALUES ('$nombre', '$fecha_nacimiento', '$sexo')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capturar Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            margin: 8px 4px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Capturar Datos</h2>
    <form method="post" action="">
        Nombre: <input type="text" name="nombre" required><br>
        Fecha de Nacimiento: <input type="date" name="fecha_nacimiento" required><br>
        Sexo: <input type="text" name="sexo" required><br>
        <input type="submit" value="Guardar">
        <input type="button" value="Editar" onclick="window.location.href='editar.php'">
        <input type="button" value="Generar PDF" onclick="window.location.href='pdf.php'">
    </form>
</body>
</html>


