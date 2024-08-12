<?php
// Inicializar el plugin
function diego_navarro_extensiones_init() {
    // Incluir archivos necesarios
    $includes_path = plugin_dir_path(__FILE__);
    include_once $includes_path . 'auth.php';
    include_once $includes_path . 'pages.php';
    include_once $includes_path . 'settings.php';
    include_once $includes_path . 'shortcodes.php';
    include_once $includes_path . 'token.php';
    include_once $includes_path . 'log-ingreso.php';
}
add_action('init', 'diego_navarro_extensiones_init');

// Función para inicializar la sesión
function diego_nav_init_plugin() {
    // Iniciar la sesión
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'diego_nav_init_plugin');

// Permitir subida de archivos SVG si la opción está activada
function diego_nav_enable_svg_uploads($mime_types) {
    if (get_option('diego_nav_enable_svg_uploads')) {
        $mime_types['svg'] = 'image/svg+xml';
    }
    return $mime_types;
}
add_filter('upload_mimes', 'diego_nav_enable_svg_uploads');

// Crear o eliminar archivo robots.txt según la opción seleccionada
function diego_nav_manage_robots_txt() {
    $robots_file = ABSPATH . 'robots.txt';
    if (get_option('diego_nav_disable_robots')) {
        $robots_content = "User-agent: *\nDisallow: /";
        file_put_contents($robots_file, $robots_content);
    } else {
        if (file_exists($robots_file)) {
            unlink($robots_file);
        }
    }
}
add_action('admin_init', 'diego_nav_manage_robots_txt');
?>
