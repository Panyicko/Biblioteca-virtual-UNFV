<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acceso no permitido.');
}

$nombre = trim($_POST['nombre'] ?? '');
$email  = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmar = $_POST['confirm_password'] ?? '';

if ($nombre === '' || $email === '' || $password === '' || $confirmar === '') {
    echo '<h2>Completa todos los campos.</h2><a href="primeracapa.html">Volver</a>';
    exit;
}

if ($password !== $confirmar) {
    echo '<h2>Las contraseñas no coinciden.</h2><a href="primeracapa.html">Volver</a>';
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare('INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $nombre, $email, $hash);

if ($stmt->execute()) {
    echo '<h2>Registro correcto.</h2>';
    echo '<p>El usuario se guardó correctamente.</p>';
    echo '<p><a href="usuarios.php">Ver usuarios registrados</a></p>';
} else {
    echo '<h2>No se pudo registrar.</h2>';
    echo '<p>' . htmlspecialchars($stmt->error) . '</p>';
    echo '<p><a href="primeracapa.html">Volver</a></p>';
}

$stmt->close();
$mysqli->close();
?>
