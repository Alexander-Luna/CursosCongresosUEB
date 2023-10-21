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
    <div class="br-mainpanel">

        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <p></p>

                <div class="table-wrapper"></div>
                <table id="cursos_data" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-15p">Facultad</th>
                            <th class="wd-15p">Nombre</th>
                            <th class="wd-15p">Fech.Inicio</th>
                            <th class="wd-20p">Fech.Fin</th>
                            <th class="wd-15p">Instructor</th>
                            <th class="wd-10p"></th>
                            <th class="wd-10p"></th>
                            <th class="wd-10p"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Itera a través de los resultados de la consulta y muestra las filas de la tabla
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['facultad'] . "</td>";
                            echo "<td>" . $row['nombre_curso'] . "</td>";
                            echo "<td>" . $row['fecha_inicio'] . "</td>";
                            echo "<td>" . $row['fecha_fin'] . "</td>";
                            echo "<td>" . $row['nombre_instructor'] . "</td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
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