<?php
/*
Plugin Name: Diego Navarro - Extensiones
Description: Plugin para añadir funciones personalizadas y configuraciones adicionales al sitio web.
Version: 1.1
Author: Diego Navarro
Plugin URI: https://diegonr.com
*/

// Definir constantes
define('DIEGO_NAV_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('DIEGO_NAV_PLUGIN_URL', plugin_dir_url(__FILE__));

// Incluir archivos necesarios
require_once DIEGO_NAV_PLUGIN_DIR . 'includes/init.php';
require_once DIEGO_NAV_PLUGIN_DIR . 'includes/auth.php';
require_once DIEGO_NAV_PLUGIN_DIR . 'includes/pages.php';
require_once DIEGO_NAV_PLUGIN_DIR . 'includes/settings.php';
require_once DIEGO_NAV_PLUGIN_DIR . 'includes/log-ingreso.php'; // Nuevo archivo incluido

// Inicializar el plugin
add_action('init', 'diego_nav_init_plugin');

// Añadir la plantilla personalizada al selector de plantillas
add_filter('theme_page_templates', 'diego_nav_add_template_to_select');
function diego_nav_add_template_to_select($templates) {
    $templates['templates/page-ingreso.php'] = 'Ingreso';
    return $templates;
}

// Cargar la plantilla personalizada
add_filter('template_include', 'diego_nav_load_template');
function diego_nav_load_template($template) {
    if (is_page_template('templates/page-ingreso.php')) {
        $template = DIEGO_NAV_PLUGIN_DIR . 'templates/page-ingreso.php';
    }
    return $template;
}

// Desactivar actualizaciones de Elementor y pe-core
function diego_nav_disable_plugin_updates($value) {
    if (get_option('diego_nav_disable_elementor_updates')) {
        unset($value->response['elementor/elementor.php']);
    }
    unset($value->response['pe-core/pe-core.php']); // Desactivar actualizaciones de pe-core obligatoriamente
    return $value;
}
add_filter('site_transient_update_plugins', 'diego_nav_disable_plugin_updates');

// Añadir enlace de ajustes en la página de plugins
function diego_nav_plugin_settings_link($links) {
    $settings_link = '<a href="admin.php?page=diego_nav_settings">Ajustes</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'diego_nav_plugin_settings_link');
?>
