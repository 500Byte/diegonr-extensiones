<?php
// Añadir la página de configuración al menú de WordPress
function diego_nav_add_settings_page() {
    add_menu_page(
        'Configuración de Extensiones', // Título de la página
        'Extensiones',                  // Título del menú
        'manage_options',               // Capacidad
        'diego_nav_settings',           // Slug del menú
        'diego_nav_render_settings_page', // Función para mostrar la página
        'data:image/svg+xml;base64,' . base64_encode('
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#101010">
                <path d="M424.64 87.35C379.59 42.3 319.7 17.5 256 17.5S132.4 42.31 87.36 87.36c-22.26 22.26-39.66 48.29-51.7 77.38-12.05 29.08-18.15 59.79-18.15 91.28 0 63.7 24.81 123.59 69.86 168.64C132.41 469.7 192.3 494.51 256 494.51h.65a235.8 235.8 0 0 0 90.68-18.04c29.1-12.06 55.12-29.49 77.33-51.82 45.05-45.05 69.85-104.94 69.85-168.64s-24.81-123.6-69.86-168.64zM256 475.19c-120.87 0-219.21-98.33-219.21-219.19S135.13 36.8 256 36.8 475.19 135.13 475.19 256 376.86 475.19 256 475.19zm111.73-148.23c-45.59-3.28-83.36-30.08-99.26-70.8l-.16-.36a136.53 136.53 0 0 0-125.65-82.85h-9.76V346.4h9.74c47.82 0 91.74-24.77 116.53-65.18 10.01 17.24 23.95 31.97 40.68 42.91 22.39 14.69 49.2 22.46 77.53 22.46h9.65V176.27h-19.3v150.68zm-215.5-134.33c42.07 3.4 78.67 28.7 96.7 67.04-18.03 38.34-54.63 63.63-96.7 67.04V192.63z"/>
            </svg>
        '), // Ícono del menú en base64
        2                               // Posición en el menú
    );
}
add_action('admin_menu', 'diego_nav_add_settings_page');

// Renderizar la página de configuración
function diego_nav_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>Configuración de Extensiones</h1>
        <form method="post" action="options.php" id="diego-nav-settings-form">
            <?php
            settings_fields('diego_nav_settings_group');
            do_settings_sections('diego_nav_settings');
            submit_button();
            ?>
        </form>
    </div>
    <script>
        function generateToken(password) {
            const token = btoa(password + 'nana'); // Genera un token simple usando Base64
            return token;
        }

        function updateTokenField() {
            const passwordField = document.querySelector('input[name="diego_nav_password"]');
            const tokenField = document.getElementById('diego_nav_token_field');

            if (passwordField && tokenField) {
                const token = generateToken(passwordField.value);
                tokenField.value = token;
            }
        }

        document.getElementById('diego-nav-settings-form').addEventListener('submit', function(event) {
            updateTokenField();
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateTokenField();
        });

        function copyToClipboard() {
            const tokenField = document.getElementById("diego_nav_token_field");
            const dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            dummy.value = "<?php echo home_url('/?token='); ?>" + tokenField.value;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
            const copyButton = document.getElementById("copy-button");
            copyButton.textContent = "Copiado";
        }
    </script>
    <?php
}

// Registrar configuraciones
function diego_nav_register_settings() {
    register_setting('diego_nav_settings_group', 'diego_nav_password');
    register_setting('diego_nav_settings_group', 'diego_nav_token');
    register_setting('diego_nav_settings_group', 'diego_nav_disable_elementor_updates');
    register_setting('diego_nav_settings_group', 'diego_nav_enable_favicon');
    register_setting('diego_nav_settings_group', 'diego_nav_enable_svg_uploads');
    register_setting('diego_nav_settings_group', 'diego_nav_disable_robots');

    add_settings_section(
        'diego_nav_settings_section',
        'Configuración de Credenciales',
        null,
        'diego_nav_settings'
    );

    add_settings_field(
        'diego_nav_password',
        'Contraseña',
        'diego_nav_password_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );

    add_settings_field(
        'diego_nav_token',
        'Token (Generado Automáticamente)',
        'diego_nav_token_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );

    add_settings_field(
        'diego_nav_disable_elementor_updates',
        'Desactivar Actualizaciones de Elementor',
        'diego_nav_disable_elementor_updates_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );

    add_settings_field(
        'diego_nav_enable_favicon',
        'Activar Favicon SVG',
        'diego_nav_enable_favicon_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );

    add_settings_field(
        'diego_nav_enable_svg_uploads',
        'Permitir Subida de SVG',
        'diego_nav_enable_svg_uploads_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );

    add_settings_field(
        'diego_nav_disable_robots',
        'Deshabilitar Acceso de Robots',
        'diego_nav_disable_robots_field_render',
        'diego_nav_settings',
        'diego_nav_settings_section'
    );
}
add_action('admin_init', 'diego_nav_register_settings');

function diego_nav_password_field_render() {
    $password = get_option('diego_nav_password');
    ?>
    <input type="text" name="diego_nav_password" value="<?php echo esc_attr($password); ?>" />
    <?php
}

function diego_nav_token_field_render() {
    $token = get_option('diego_nav_token');
    ?>
    <input type="text" name="diego_nav_token" id="diego_nav_token_field" value="<?php echo esc_attr($token); ?>" readonly />
    <button type="button" id="copy-button" onclick="copyToClipboard()">Copiar URL <i class="fa-solid fa-copy"></i></button>
    <?php
}

function diego_nav_disable_elementor_updates_field_render() {
    $disable_updates = get_option('diego_nav_disable_elementor_updates');
    ?>
    <input type="checkbox" name="diego_nav_disable_elementor_updates" value="1" <?php checked($disable_updates, 1); ?> />
    <?php
}

function diego_nav_enable_favicon_field_render() {
    $enable_favicon = get_option('diego_nav_enable_favicon');
    ?>
    <input type="checkbox" name="diego_nav_enable_favicon" value="1" <?php checked($enable_favicon, 1); ?> />
    <?php
}

function diego_nav_enable_svg_uploads_field_render() {
    $enable_svg_uploads = get_option('diego_nav_enable_svg_uploads');
    ?>
    <input type="checkbox" name="diego_nav_enable_svg_uploads" value="1" <?php checked($enable_svg_uploads, 1); ?> />
    <?php
}

function diego_nav_disable_robots_field_render() {
    $disable_robots = get_option('diego_nav_disable_robots');
    ?>
    <input type="checkbox" name="diego_nav_disable_robots" value="1" <?php checked($disable_robots, 1); ?> />
    <?php
}

// Añadir el favicon si la opción está activada
function diego_nav_add_favicon() {
    if (get_option('diego_nav_enable_favicon')) {
        echo '<link rel="icon" type="image/svg+xml" href="' . plugin_dir_url(__FILE__) . '../assets/favicon.svg">';
    }
}
add_action('wp_head', 'diego_nav_add_favicon');
add_action('admin_head', 'diego_nav_add_favicon');
?>
