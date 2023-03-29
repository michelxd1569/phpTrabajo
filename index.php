<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="nombre_cliente">Nombre del cliente:</label>
        <input type="text" id="nombre_cliente" name="nombre_cliente">
        <button type="submit" name="buscar">Buscar</button>
    </form>
</body>
</html>

<?php


    if (isset($_POST['buscar'])) {
        $nombre_cliente = $_POST['nombre_cliente'];
        $serverName = "michelbal.database.windows.net"; // Nombre de tu servidor de base de datos
        $databaseName = "BDMARKET_2"; // Nombre de tu base de datos
        $username = "administrador"; // Tu nombre de usuario
        $password = "CausaxD1478$"; // Tu contraseña
        try {
            // Crear la conexión PDO
            $pdo = new PDO("sqlsrv:server=$serverName;database=$databaseName", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Ejecutar la consulta para otorgar permisos al usuario
            // Consulta PDO
            $consulta = $pdo->prepare("SELECT * FROM cliente WHERE nombre LIKE ?");
            $consulta->execute(array("$nombre_cliente%"));

            echo '<table border="1">';
            echo '<tr><th>nombre</th><th>numruc</th><th>direccion</th><th>telefono</th</tr>';
            // Mostrar resultados de la consulta
            while ($fila = $consulta->fetch()) {
                echo '<tr>';
                echo '<td>' . $fila['nombre'] . '</td>';
                echo '<td>' . $fila['numruc'] . '</td>';
                echo '<td>' . $fila['direccion'] . '</td>';
                echo '<td>' . $fila['telefono'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
    }
?>