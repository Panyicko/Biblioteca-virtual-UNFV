<?php
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

$error = $_SESSION['error_login'] ?? '';
unset($_SESSION['error_login']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuario === 'admin' && $password === 'admin123') {
        unset($_SESSION['error_login']);
        $_SESSION['admin_logged_in'] = true;
        header('Location: usuarios.php');
        exit;
    }

    $_SESSION['error_login'] = 'Credenciales incorrectas.';
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso administrador</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { max-width: 300px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>Acceso administrador</h2>
    <?php if (!empty($error)) echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>'; ?>
    <form method="post">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
