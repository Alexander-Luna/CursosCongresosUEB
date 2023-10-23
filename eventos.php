<?php
// Archivo de conexión a la base de datos (conexion.php)
$host = "localhost";  // Cambia esto al nombre del servidor de tu base de datos
$usuario = "root";  // Cambia esto a tu nombre de usuario de la base de datos
$contrasena = "";  // Cambia esto a tu contraseña de la base de datos
$base_de_datos = "cursoscongresosueb";  // Cambia esto al nombre de tu base de datos

$conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

if (!$conexion) {
    die("Error en la conexión a la base de datos: " . mysqli_connect_error());
}

// Realiza una consulta SQL para obtener la información de los cursos
$query = "SELECT
            c.cur_id,
            f.cat_nom AS facultad,
            c.cur_nom AS nombre_curso,
            c.portada_img,
            c.cur_fechini AS fecha_inicio,
            c.cur_fechfin AS fecha_fin,
            i.inst_nom AS nombre_instructor
          FROM tm_curso c
          JOIN tm_facultades f ON c.cat_id = f.cat_id
          JOIN tm_instructor i ON c.inst_id = i.inst_id
          WHERE c.est = 1"; // Solo cursos con estado 1 (activos)
$result = mysqli_query($conexion, $query);

if (!$result) {
    die("Error al ejecutar la consulta: " . mysqli_error($conexion));
}
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
        <div class="br-mainpanel">
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <?php
                    // Asumiendo que $result es un array de resultados
                    foreach ($result as $row) {
                    ?>
                        <div class="card">
                            <!-- Agrega la imagen debajo del título -->
                            <h3 class="card__title"><?php echo $row['nombre_curso']; ?></h3>
                            <img class="card__image" src="<?php echo $row['portada_img']; ?>" alt="<?php echo $row['nombre_curso']; ?>">
                            <p class="card__content">Facultad: <?php echo $row['facultad']; ?></p>
                            <p class="card__content">Fecha de Inicio: <?php echo $row['fecha_inicio']; ?></p>
                            <p class="card__content">Fecha de Finalización: <?php echo $row['fecha_fin']; ?></p>
                            <p class="card__content">Instructor: <?php echo $row['nombre_instructor']; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <Footer id="pie_pagina">
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
                    <a href="https://twitter.com" target="_blank" rel="noreferrer">
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
    </Footer>
    <script type="text/javascript" src="adminmntcurso.js"></script>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>