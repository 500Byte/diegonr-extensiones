<?php
/*
Template Name: Ingreso
*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ingreso - Diego Navarro</title>
    <meta name="author" content="Diego Navarro">
    <meta name="description" content="Acceso al portafolio profesional de Diego Navarro, especializado en diseño UI/UX y desarrollo Front-End.">
    <meta name="keywords" content="UI/UX, Front-End, diseño web, desarrollo web, Diego Navarro">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500&display=swap" rel="stylesheet">
    <link href="<?php echo plugin_dir_url(__FILE__) . '../assets/css/plugins.css'; ?>" rel="stylesheet">
    <link href="<?php echo plugin_dir_url(__FILE__) . '../assets/css/style.css'; ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo plugin_dir_url(__FILE__) . '../assets/img/site-favicon.png'; ?>">
    <link rel="apple-touch-icon" href="<?php echo plugin_dir_url(__FILE__) . '../assets/img/site-favicon.png'; ?>">
</head>
<body data-barba="wrapper" style="--mainBackground: #000; --mainColor: #fff;">
    <div class="page-loader" style="background: #000;">
        <div class="page-loader-logo">
            <img alt="Logo de carga de página" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/page-loader-logo-light.png'; ?>">
        </div>
    </div>
    <div class="ego-page-transition block up light">
        <div class="page-transition-caption">
            Cargando, por favor espera...
        </div>
    </div>
    <div id="mouseCursor" class="dot light"></div>
    <div id="page">
        <div class="menu-overlay"></div>
        <div id="header" class="site-header dynamic blend light">
            <div class="header-wrapper wrapper-full">
                <div class="c-col-6">
                    <div class="site-branding">
                        <div class="site-logo">
                            <img alt="Logo del Sitio (Oscuro)" class="dark-logo" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/site-logo-type-dark.png'; ?>">
                            <img alt="Logo del Sitio (Claro)" class="light-logo" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/site-logo-type-light.png'; ?>">
                        </div>
                        <div class="sticky-logo">
                            <img alt="Logo Sticky (Oscuro)" class="sticky-dark-logo" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/sticky_logo.png'; ?>">
                            <img alt="Logo Sticky (Claro)" class="sticky-light-logo" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/sticky_logo_light.png'; ?>">
                        </div>
                    </div>
                </div>
                <div class="c-col-6 align-right">
                    <div class="ego-button underline">
                        <a href="#">Contáctame</a>
                    </div>
                </div>
            </div>
        </div>
        <main id="primary" class="site-main" data-barba="container">
            <div id="content" class="page-content">
                <div class="section fullscreen" style="padding-top: 0;">
                    <div class="section-background hide-mobile" style="height: 100vh;">
                        <div class="circle-mask-background">
                            <img src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/coming-soon-bg.jpg'; ?>" alt="Background">
                        </div>
                    </div>
                    <div class="wrapper-small blend">
                        <div class="c-col-10 sm-12 col-center mobile-self-bottom self-center">
                            <div class="text-wrapper">
                                <p class="has-anim-text wordsUp">BIENVENIDO A MI PORTAFOLIO</p>
                                <span class="empty-space" style="height: 50px;"></span>
                                <h4 class="has-anim-text wordsUp">Por favor, introduce tu contraseña para acceder a mis proyectos y casos de estudio.</h4>
                            </div>
                            <div class="ego-subscribe-form text-h5 has-anim fadeUp">
                                <div class="login-form">
                                    <?php if (isset($_GET['error'])): ?>
                                        <p class="error">Credenciales incorrectas.</p>
                                    <?php endif; ?>
                                    <form id="login-form" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                        <div class="field-wrap">
                                            <input id="password-input" name="password" type="text" placeholder="Introduce tu contraseña" required autocomplete="off">
                                        </div>
                                        <div class="send-wrap">
                                            <button type="submit" class="button button-block">Acceder</button>
                                        </div>
                                        <input type="hidden" name="action" value="diego_nav_login">
                                        <input type="hidden" name="redirect_to" value="<?php echo esc_url($_GET['redirect_to'] ?? home_url()); ?>">
                                    </form>
                                </div>
                            </div>
                            <div class="text-wrapper">
                                <span class="empty-space" style="height: 50px;"></span>
                                <p class="caption has-anim-text wordsUp"></p>
                                <span class="empty-space" style="height: 50px;"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/jquery.min.js'; ?>"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/plugins.js'; ?>"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/barba.min.js'; ?>"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/gsap.js'; ?>"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . '../assets/js/scripts.js'; ?>"></script>
</body>
</html>
