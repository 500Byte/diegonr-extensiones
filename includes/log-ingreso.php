<?php

function diego_nav_log_login_attempt($success, $page_slug) {
    $log_entry = sprintf(
        "[%s] IP: %s - Página: %s - Resultado: %s\n",
        date("Y-m-d H:i:s"),
        $_SERVER['REMOTE_ADDR'],
        $page_slug,
        $success ? 'Exitoso' : 'Fallido'
    );

    $log_file = DIEGO_NAV_PLUGIN_DIR . 'logs/login_attempts.log';
    file_put_contents($log_file, $log_entry, FILE_APPEND);
}

function diego_nav_display_login_logs() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['clear_logs'])) {
        diego_nav_clear_login_logs();
        echo '<div class="updated"><p>Registros limpiados exitosamente.</p></div>';
    }

    $log_file = DIEGO_NAV_PLUGIN_DIR . 'logs/login_attempts.log';
    $logs = [];

    if (file_exists($log_file)) {
        $logs = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    ?>
    <div class="wrap">
        <h1>Registros de Intentos de Inicio de Sesión</h1>
        <form method="post" action="">
            <input type="hidden" name="clear_logs" value="1">
            <button type="submit" class="button button-primary">Vaciar Registros</button>
        </form>
        <table class="widefat fixed" cellspacing="0" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Hora</th>
                    <th>IP</th>
                    <th>Página</th>
                    <th>Resultado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logs)): ?>
                    <tr>
                        <td colspan="4">No hay registros disponibles.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($logs as $log): ?>
                        <?php
                        // Parsear el registro
                        preg_match('/\[(.*?)\] IP: (.*?) - Página: (.*?) - Resultado: (.*)/', $log, $matches);
                        if ($matches):
                        ?>
                        <tr>
                            <td><?php echo esc_html($matches[1]); ?></td>
                            <td><?php echo esc_html($matches[2]); ?></td>
                            <td><?php echo esc_html($matches[3]); ?></td>
                            <td><?php echo esc_html($matches[4]); ?></td>
                        </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}

function diego_nav_clear_login_logs() {
    $log_file = DIEGO_NAV_PLUGIN_DIR . 'logs/login_attempts.log';
    if (file_exists($log_file)) {
        file_put_contents($log_file, '');
    }
}

function diego_nav_add_log_submenu_page() {
    add_submenu_page(
        'diego_nav_settings',
        'Registros de Inicio de Sesión',
        'Registros de Inicio de Sesión',
        'manage_options',
        'diego_nav_login_logs',
        'diego_nav_display_login_logs'
    );
}
add_action('admin_menu', 'diego_nav_add_log_submenu_page');
?>
