<?php
function diego_nav_login_form() {
    if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
        wp_redirect(home_url());
        exit;
    }

    $redirect_to = isset($_GET['redirect_to']) ? esc_url($_GET['redirect_to']) : home_url();

    ob_start();
    ?>
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
            <input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>">
        </form>
    </div>
    <?php
    return ob_get_clean();
}

// Registrar shortcode
add_shortcode('diego_nav_login_form', 'diego_nav_login_form');
