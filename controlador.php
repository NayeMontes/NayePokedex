<?php
session_start();

// 1. Detectar si el usuario le dio clic a "Entrar como invitado"
// Creamos la sesión con datos temporales
if (isset($_GET['acceso']) && $_GET['acceso'] === 'invitado') {
    $_SESSION['usuario'] = 'Invitado';
    $_SESSION['rol'] = 'invitado';
    
    // Lo mandamos directo al inicio de la Pokédex
    header("Location: pokedex.php");
    exit();
}

if (isset($_POST['btn_login'])) {

    if (empty($_POST["usuario"]) || empty($_POST["password"])) {
        echo '<div class="alert alert-danger">Los campos están vacíos :c</div>';
    } else {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        
        // Preparamos la consulta con signos de interrogación 
        $stmt = $conexion->prepare("SELECT * FROM users WHERE usuario = ? AND password = ?");
        
        $stmt->bind_param("ss", $usuario, $password);
        
        // Ejecutamos la consulta
        $stmt->execute();
        
        // Obtenemos el resultado
        $resultado = $stmt->get_result();
        
        if ($datos = $resultado->fetch_object()) {
            header("location:Pokedex-main/index.html");
            exit(); 
        } else {
            echo '<div class="alert alert-danger">Acceso denegado :c</div>';
        }
        
        $stmt->close();
    }
}
?>