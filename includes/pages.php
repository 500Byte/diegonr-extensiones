<?php
function diego_nav_create_login_page() {
    if (get_page_by_path('ingreso')) return;

    $page = array(
        'post_title'    => 'Ingreso',
        'post_content'  => '[diego_nav_login_form]',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page',
        'page_template' => 'templates/page-ingreso.php'
    );
    wp_insert_post($page);
}

// Crear la página de inicio de sesión al inicializar el plugin
add_action('init', 'diego_nav_create_login_page');
