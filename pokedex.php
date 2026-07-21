<?php
// 1. Iniciar el sistema de sesiones de PHP
session_start();

// 2. Candado de seguridad: Si intentan entrar directo a este archivo sin pasar por el login, los mandamos de vuelta
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

// 3. Guardamos si es invitado o no en una variable corta
$esInvitado = ($_SESSION['rol'] === 'invitado');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NayePokedex - Modo Invitado</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 450px;
        }
        h1 { color: #ef5350; margin-top: 0; }
        .alerta {
            background-color: #fff3cd;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ffeeba;
            margin: 20px 0;
            font-size: 14px;
        }
        .btn-regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #37474f;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>🔴 ¡Conexión Exitosa!</h1>
        
        <!-- Mostramos el nombre dinámicamente ("Invitado") -->
        p2>¡Hola, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>!</p2>

        <!-- Mensaje exclusivo si entró como invitado -->
        <?php if ($esInvitado): ?>
            <div class="alerta">
                ✨ Estás navegando en <strong>Modo Lectura</strong>. Puedes explorar la Pokédex, pero las opciones de agregar o borrar Pokémon estarán deshabilitadas.
            </div>
        <?php endif; ?>

        <p>Próximamente aquí desplegaremos tu base de datos y tu buscador de Pokémon.</p>
        
        <br>
        <a href="index.html" class="btn-regresar">Regresar al Login</a>
    </div>

</body>
</html>