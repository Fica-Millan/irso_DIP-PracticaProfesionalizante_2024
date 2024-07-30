<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar si es usuario
    $stmt_user = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt_user->bind_param("s", $email);
    $stmt_user->execute();
    $stmt_user->store_result();

    if ($stmt_user->num_rows == 1) {
        $stmt_user->bind_result($id, $nombre, $hashed_password);
        $stmt_user->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_type'] = 'user';

            // Redirigir al usuario a la página principal
            header("Location: ./user_sesion.php");
            exit();
        } else {
            $_SESSION['error'] = 'Contraseña incorrecta';
        }
    } else {
        $_SESSION['error'] = 'Usuario no encontrado';
    }

    $stmt_user->close();
    header("Location: ../index.php");
    exit();
}
?>

