<?php
session_start();
require 'db.php';

if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

$result = $mysqli->query('SELECT id, nombre, email, fecha_registro FROM usuarios ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios registrados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        a { color: #0b5fff; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Usuarios registrados</h1>
    <p><a href="primeracapa.html">Volver al registro</a></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['fecha_registro']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay usuarios registrados todavía.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
