<?php
require_once('../../config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../styles/index.css">
    <link rel="stylesheet" href="../../styles/eventos.css">
    <?php require_once("../html/MainHead.php"); ?>

</head>

<body>
    <header>
        <nav class="nav">
            <div class="logo_container">
                <img id="logo" src="../../assets/logo_ueb.png" alt="Logo">
            </div>
            <ul class="nav_ul">
                <li><a class="nav_li" href="../index.php">Inicio</a></li>
                <li><a class="nav_li" href="../eventspublic">Eventos</a></li>
                <li><i class="fa-solid fa-user"></i><a class="nav_li" href="../login/"> Login</a></li>
                <!-- <li><a class="nav_li" href="registro.php">Registrarse</a></li> -->
            </ul>
        </nav>
    </header>
    <section class="container__card">
        <div id="eventos-container" class="grid__container section__card">
            <!-- Aquí irán tus tarjetas -->
        </div>
    </section>

    <footer id="pie_pagina">
        <div id="grupo_1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../../assets/logo_ueb.png" alt="Descripción de la imagen" />
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
                <h2>SÍGUENOS</h2>
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
    <?php require_once("../html/MainJs.php"); ?>

    <script src="index.js" defer></script>
</body>

</html>