<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "cursoscongresosueb";

$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

$query = "SELECT
            c.cur_id,
            f.cat_nom AS facultad,
            c.cur_nom AS nombre_curso,
            c.portada_img,
            c.cur_fechini AS fecha_inicio,
            c.cur_fechfin AS fecha_fin,
            i.inst_nom AS nombre_instructor,
            i.inst_apep AS apellido_instructor
          FROM tm_curso c
          JOIN tm_facultades f ON c.cat_id = f.cat_id
          JOIN tm_instructor i ON c.inst_id = i.inst_id
          WHERE c.est = 1"; // Solo cursos con estado 1 (activos)
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}

// Asumiendo que $result es un array de resultados
$eventos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/eventos.css">
    <script src="scripts/index.js" defer></script>
</head>

<body>
    <header>
        <nav class="nav">
            <div class="logo_container">
                <img id="logo" src="assets/logo_ueb.png" alt="Logo">
            </div>
            <ul class="nav_ul">
                <li><a class="nav_li" href="index.php">Inicio</a></li>
                <li><a class="nav_li" href="eventos.php">Eventos</a></li>
                <li><i class="fa-solid fa-user"></i><a class="nav_li" href="login.php"> Login</a></li>
                <!-- <li><a class="nav_li" href="registro.php">Registrarse</a></li> -->
            </ul>
        </nav>
    </header>
    <section class="container__card">
        <div class="grid__container section__card">
            <!-- Aquí irán tus tarjetas -->
            <?php
            // Asumiendo que $eventos es un array de resultados
            foreach ($eventos as $evento) {
            ?>
                <div class="cardE">
                    <div class="cardE-image">
                        <img src="<?php echo $evento['portada_img']; ?>" alt="<?php echo $evento['nombre_curso']; ?>">
                    </div>
                    <div class="category">
                        <h3 class="cardE__title">
                            <?php echo $evento['nombre_curso']; ?>
                        </h3>
                    </div>
                    <div class="heading">
                        <p class="cardE__content">Facultad:
                            <?php echo $evento['facultad']; ?>
                        </p>
                        <p class="cardE__content">Fecha de Inicio:
                            <?php echo $evento['fecha_inicio']; ?>
                        </p>
                        <p class="cardE__content">Fecha de Finalización:
                            <?php echo $evento['fecha_fin']; ?>
                        </p>
                        <div class="author"> Por <span class="name">
                                <p class="cardE__content">
                                    <?php echo $evento['nombre_instructor'] . ' ' . $evento['apellido_instructor']; ?>
                                </p>
                            </span> </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </section>

    <footer id="pie_pagina">
        <div id="grupo_1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="assets/logo_ueb.png" alt="Descripción de la imagen" />
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>CONTACTOS</h2>
                <p>
                    <i class="fa-solid fa-phone"></i> Tel: (593) 32206010 - 32206014
                </p>
                <p>
                    <i class="fa-brands fa-whatsapp"></i> (+593) 987654321
                </p>
                <p>
                    <i class="fa-solid fa-envelope"></i> ponercorreodelaueb
                </p>
                <p>
                    <i class="fa-solid fa-location-dot"></i> Av. Ernesto Che Guevara s/n y Av. Gabriel Secaira
                </p>
            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red_social">
                    <a href="https://facebook.com" target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https.twitter.com" target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCml4cc2U6oWm7jG9iayK3UA/videos" target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://whatsapp.com" target="_blank" rel="noreferrer">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <script type="text/javascript" src="adminmntcurso.js"></script>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>